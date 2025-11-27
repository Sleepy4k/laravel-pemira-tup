document.addEventListener('DOMContentLoaded', function() {
    var formStatus = {
        usernameValid: false,
        passwordValid: false,
        rateLimited: false
    }

    function isFormValid() {
        return formStatus.usernameValid && formStatus.passwordValid;
    }

    const togglePasswordBtn = document.getElementById('toggle-password-btn');
    if (togglePasswordBtn) {
        togglePasswordBtn.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            if (!passwordInput || !eyeIcon || !eyeSlashIcon) return;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordInput.placeholder = "Password123!";
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                passwordInput.placeholder = "••••••••••••";
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        });
    }

    function displayInfoMessage(message, isError = true) {
        const infoContainer = document.getElementById('info-container');
        if (infoContainer) {
            infoContainer.textContent = message;
            infoContainer.classList.remove('hidden');
            if (isError) {
                infoContainer.classList.add('text-red-600');
                infoContainer.classList.remove('text-green-600');
            } else {
                infoContainer.classList.add('text-green-600');
                infoContainer.classList.remove('text-red-600');
            }
        }
    }

    function clearInfoMessage() {
        const infoContainer = document.getElementById('info-container');
        if (infoContainer) {
            infoContainer.classList.add('hidden');
            infoContainer.textContent = '';
        }
    }

    function changeButtonState(isDisabled) {
        const submitButton = document.getElementById('signin-submit-btn');
        if (submitButton) {
            submitButton.disabled = isDisabled;
            if (isDisabled) {
                submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                submitButton.classList.remove('hover:opacity-95');
            } else {
                submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                submitButton.classList.add('hover:opacity-95');
            }
            return submitButton;
        }
        return null;
    }

    function changeFormState(isDisabled) {
        const signinForm = document.getElementById('signin-form');
        if (signinForm) {
            Array.from(signinForm.elements).forEach(element => {
                element.disabled = isDisabled;
                if (isDisabled) {
                    element.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    element.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            });
        }
        changeButtonState(isDisabled);
    }

    function showNotification(type, message) {
        if (typeof window.Toast !== "undefined") {
            window.Toast.fire({
                icon: type,
                title: message
            });
        } else {
            alert(message);
        }
    }

    function buttonLoadingState(isLoading) {
        const button = changeButtonState(isLoading);
        if (!button) return;

        if (isLoading) {
            button.dataset.originalText = button.innerHTML;
            button.innerHTML = 'Signing in...';
        } else {
            if (button.dataset.originalText) {
                button.innerHTML = button.dataset.originalText;
            }
        }
    }

    // get header data for rate limiting
    const header = document.querySelector('header[data-remaining][data-reset-at]');
    if (header) {
        const remaining = parseInt(header.getAttribute('data-remaining'), 10);
        const resetAt = parseInt(header.getAttribute('data-reset-at'), 10);

        if (remaining <= 0 && resetAt) {
            formStatus.rateLimited = true;
            changeFormState(true);

            let remainingSeconds = resetAt;

            const updateCountdown = () => {
                const minutes = Math.floor(remainingSeconds / 60);
                const seconds = remainingSeconds % 60;
                const timeString = minutes > 0
                    ? `${minutes} minute(s) and ${seconds} second(s)`
                    : `${seconds} second(s)`;

                displayInfoMessage(`Too many failed attempts. Please wait ${timeString} before trying again.`);

                if (remainingSeconds > 0) {
                    remainingSeconds--;
                    setTimeout(updateCountdown, 1000);
                } else {
                    formStatus.rateLimited = false;
                    changeFormState(false);
                    clearInfoMessage();
                }
            };

            updateCountdown();
        }
    }

    const signinForm = document.getElementById('signin-form');
    if (signinForm) {
        signinForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const actionUrl = signinForm.getAttribute('data-action');

            if (actionUrl) {
                if (!isFormValid()) {
                    showNotification('error', 'Please fix the errors in the form before submitting.');
                    return;
                }

                const formData = new FormData();
                formData.append('username', document.getElementById('username').value || '');
                formData.append('password', document.getElementById('password').value || '');

                buttonLoadingState(true);

                window.axios.post(actionUrl, formData).then(response => {
                    if (response.data && response.data.status === 'success') {
                        showNotification('success', 'Sign in successful! Redirecting...');
                        const redirectUrl = signinForm.getAttribute('data-redirect') || '/';
                        window.location.href = redirectUrl;
                    } else {
                        showNotification('error', response.data.message || 'Sign in failed. Please try again.');
                    }
                }).catch(error => {
                    if (error.response?.data?.data?.remaining !== undefined &&
                        error.response.data.data.reset_at !== undefined) {
                        const rateLimiter = error.response.data.data;

                        if (rateLimiter.remaining <= 0) {
                            changeFormState(true);
                            formStatus.rateLimited = true;
                            let remainingSeconds = rateLimiter.reset_at;

                            const updateCountdown = () => {
                                const minutes = Math.floor(remainingSeconds / 60);
                                const seconds = remainingSeconds % 60;
                                const timeString = minutes > 0
                                    ? `${minutes} minute(s) and ${seconds} second(s)`
                                    : `${seconds} second(s)`;

                                displayInfoMessage(`Too many failed attempts. Please wait ${timeString} before trying again.`);

                                if (remainingSeconds > 0) {
                                    remainingSeconds--;
                                    setTimeout(updateCountdown, 1000);
                                } else {
                                    formStatus.rateLimited = false;
                                    changeFormState(false);
                                    clearInfoMessage();
                                }
                            };

                            updateCountdown();
                            return;
                        }
                    }

                    if (error.response && error.response.data && error.response.data.message) {
                        showNotification('error', error.response.data.message);
                    } else {
                        showNotification('error', 'An error occurred. Please try again.');
                    }
                }).finally(() => {
                    buttonLoadingState(false);

                    if (formStatus.rateLimited) {
                        changeButtonState(true);
                    }
                });
            }
        });
    }

    // create live validation for username and password fields
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    // Validation helper functions
    function showError(input, message) {
        const errorElement = input.nextElementSibling;
        input.classList.add('border-red-500');
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        } else {
            const error = document.createElement('span');
            error.className = 'error-message text-red-500 text-sm mt-1';
            error.textContent = message;
            input.parentNode.insertBefore(error, input.nextSibling);
        }
    }

    function clearError(input) {
        const errorElement = input.nextElementSibling;
        input.classList.remove('border-red-500');
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.textContent = '';
            errorElement.classList.add('hidden');
        }
    }

    function validateUsername(value) {
        if (!value || value.trim() === '') {
            return 'Username is required';
        }
        if (value.length < 3) {
            return 'Username must be at least 3 characters';
        }
        if (value.length > 20) {
            return 'Username must not exceed 20 characters';
        }
        return null;
    }

    function validatePassword(value) {
        if (!value || value.trim() === '') {
            return 'Password is required';
        }
        if (value.length < 8) {
            return 'Password must be at least 8 characters';
        }
        if (value.length > 64) {
            return 'Password must not exceed 64 characters';
        }
        return null;
    }

    // Live validation
    if (usernameInput) {
        usernameInput.addEventListener('blur', function() {
            const error = validateUsername(this.value);
            if (error) {
                showError(this, error);
                formStatus.usernameValid = false;
            } else {
                clearError(this);
                formStatus.usernameValid = true;
            }
        });

        usernameInput.addEventListener('input', function() {
            if (this.classList.contains('border-red-500')) {
                const error = validateUsername(this.value);
                if (!error) {
                    clearError(this);
                    formStatus.usernameValid = true;
                } else {
                    formStatus.usernameValid = false;
                }
            }
        });
    }

    if (passwordInput) {
        passwordInput.addEventListener('blur', function() {
            const error = validatePassword(this.value);
            if (error) {
                showError(this, error);
                formStatus.passwordValid = false;
            } else {
                clearError(this);
                formStatus.passwordValid = true;
            }
        });

        passwordInput.addEventListener('input', function() {
            if (this.classList.contains('border-red-500')) {
                const error = validatePassword(this.value);
                if (!error) {
                    clearError(this);
                    formStatus.passwordValid = true;
                } else {
                    formStatus.passwordValid = false;
                }
            }
        });
    }
});

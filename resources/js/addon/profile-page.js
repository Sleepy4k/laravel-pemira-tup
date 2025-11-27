document.addEventListener("DOMContentLoaded", function () {
    function showNotification(message, type = "info") {
        if (typeof window.Toast !== "undefined") {
            window.Toast.fire({
                icon: type,
                title: message,
            });
        } else {
            alert(message);
        }
    }

    const settingsForm = document.getElementById("form-setting-account");
    if (settingsForm) {
        settingsForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(settingsForm);
            const submitButton = settingsForm.querySelector(
                'button[type="submit"]'
            );
            submitButton.disabled = true;

            axios
                .post(settingsForm.action, formData)
                .then(function (response) {
                    showNotification(
                        "Account settings updated successfully.",
                        "success"
                    );

                    setTimeout(function () {
                        window.location.reload();
                    }, 1500);
                })
                .catch(function (error) {
                    showNotification(
                        "An error occurred while updating account settings.",
                        "error"
                    );
                })
                .finally(function () {
                    submitButton.disabled = false;
                });
        });
    }

    const securityForm = document.getElementById("form-security-account");
    if (securityForm) {
        securityForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(securityForm);
            const submitButton = securityForm.querySelector(
                'button[type="submit"]'
            );
            submitButton.disabled = true;

            axios
                .post(securityForm.action, formData)
                .then(function (response) {
                    showNotification(
                        "Password changed successfully.",
                        "success"
                    );

                    setTimeout(function () {
                        window.location.reload();
                    }, 1500);
                })
                .catch(function (error) {
                    showNotification(
                        "An error occurred while changing the password.",
                        "error"
                    );
                })
                .finally(function () {
                    submitButton.disabled = false;
                });
        });
    }
});

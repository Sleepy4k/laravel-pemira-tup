document.addEventListener("DOMContentLoaded", function () {
    const backToTopBtn = document.getElementById("backToTop");

    if (backToTopBtn) {
        window.addEventListener("scroll", () => {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add("show");
            } else {
                backToTopBtn.classList.remove("show");
            }
        });

        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }

    const navButtons = document.querySelectorAll("#nav-button");
    if (navButtons) {
        navButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const redirectUrl = button.getAttribute("data-redirect");
                if (redirectUrl) {
                    window.location.href = redirectUrl;
                }
            });
        });
    }

    const logoutButton = document.getElementById("logout-button");
    if (logoutButton) {
        logoutButton.addEventListener("click", function () {
            if (typeof window.Swal === "function") {
                Swal.fire({
                    title: "Apakah Anda yakin ingin sign out?",
                    text: "Anda akan diarahkan ke halaman utama.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Ya, logout!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const logoutForm =
                            document.getElementById("logout-form");
                        if (logoutForm) {
                            logoutForm.submit();
                        }
                    }
                });
            } else {
                if (confirm("Apakah Anda yakin ingin sign out?")) {
                    const logoutForm = document.getElementById("logout-form");
                    if (logoutForm) {
                        logoutForm.submit();
                    }
                }
            }
        });
    }

    const signinButton = document.querySelectorAll("#signin-button");
    const modal = document.getElementById('sso-modal');
    const backdrop = document.getElementById('sso-modal-backdrop');
    const panel = document.getElementById('sso-modal-panel');
    const closeBtn = document.getElementById('close-modal-btn');
    const closeXBtn = document.getElementById('close-modal-x');
    const proceedBtn = document.getElementById('proceed-sso-btn');

    if (signinButton && modal && backdrop && panel && closeBtn && proceedBtn) {
        signinButton.forEach(button => {
            button.addEventListener("click", function () {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('opacity-0', 'scale-95');
                    panel.classList.add('opacity-100', 'scale-100');
                }, 10);
            });
        });

        function closeModal() {
            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        proceedBtn.addEventListener('click', function () {
            // change the button state to loading
            proceedBtn.disabled = true;
            proceedBtn.innerHTML = 'Loading...';

            const redirectUrl = proceedBtn.getAttribute('data-redirect');
            if (redirectUrl) {
                setTimeout(() => {
                    window.location.href = redirectUrl;
                }, 500); // small delay to show loading state
            }
        });

        backdrop.addEventListener('click', closeModal);
        closeBtn.addEventListener('click', closeModal);
        closeXBtn.addEventListener('click', closeModal);
    }

    // handle loader
    const loader = document.getElementById("loader");
    if (loader) {
        window.addEventListener("load", () => {
            loader.classList.add("fade-out");
            setTimeout(() => {
                loader.style.display = "none";
            }, Math.random() * 500 + 250);
        });
    }

    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    mobileMenuBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        if (mobileMenu.classList.contains("hidden")) {
            // Open menu
            mobileMenu.classList.remove("hidden");
            // Small delay to allow display:block to apply before transition
            setTimeout(() => {
                mobileMenu.classList.remove("opacity-0", "-translate-y-2");
                mobileMenu.classList.add(
                    "opacity-100",
                    "translate-y-0",
                    "flex"
                );
            }, 10);
        } else {
            // Close menu
            mobileMenu.classList.remove("opacity-100", "translate-y-0");
            mobileMenu.classList.add("opacity-0", "-translate-y-2");

            // Wait for transition to finish before hiding
            setTimeout(() => {
                mobileMenu.classList.add("hidden");
                mobileMenu.classList.remove("flex");
            }, 200);
        }
    });

    // Close menu when clicking outside
    document.addEventListener("click", function (e) {
        if (
            !mobileMenu.contains(e.target) &&
            !mobileMenuBtn.contains(e.target) &&
            !mobileMenu.classList.contains("hidden")
        ) {
            mobileMenu.classList.remove("opacity-100", "translate-y-0");
            mobileMenu.classList.add("opacity-0", "-translate-y-2");
            setTimeout(() => {
                mobileMenu.classList.add("hidden");
                mobileMenu.classList.remove("flex");
            }, 200);
        }
    });
});

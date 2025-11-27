document.addEventListener("DOMContentLoaded", function () {
    // Hide loader and show sidebar links
    const loader = document.getElementById("loader");
    const sidebarLinks = document.querySelectorAll("#sidebar-link");

    if (!loader) return;

    setTimeout(() => {
        loader.style.display = "none";
        sidebarLinks.length &&
            sidebarLinks.forEach((link) => {
                link.style.display = "flex";
            });
    }, Math.random() * 250 + 250); // Random delay between 250ms to 500ms

    // Hide main loader and show main content
    const mainLoader = document.getElementById("main-loader");
    const mainContent = document.getElementById("main-content");

    if (mainLoader && mainContent) {
        setTimeout(() => {
            mainLoader.style.display = "none";
            mainContent.style.display = "block";
        }, Math.random() * 500 + 250); // Random delay between 500ms to 750ms
    }

    // Handle sidebar toggle for smaller screens
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebar-overlay");
    const menuButton = document.getElementById("mobile-menu-button");

    if (menuButton && sidebar && overlay) {
        menuButton.addEventListener("click", function () {
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        });

        overlay.addEventListener("click", function () {
            sidebar.classList.add("-translate-x-full");
            overlay.classList.add("hidden");
        });
    }

    // Handle profile dropdown
    const dropdownButton = document.getElementById("profile-dropdown-button");
    const dropdown = document.getElementById("profile-dropdown");
    const dropdownArrow = document.getElementById("dropdown-arrow");
    const dropdownLogoutButton = document.getElementById(
        "dropdown-logout-button"
    );

    if (dropdown && dropdownButton && dropdownArrow) {
        dropdownButton.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdown.classList.toggle("hidden");
            dropdownArrow.style.transform = dropdown.classList.contains(
                "hidden"
            )
                ? "rotate(0deg)"
                : "rotate(180deg)";
        });

        document.addEventListener("click", function (e) {
            if (
                !dropdown.contains(e.target) &&
                !dropdownButton.contains(e.target)
            ) {
                dropdown.classList.add("hidden");
                dropdownArrow.style.transform = "rotate(0deg)";
            }
        });
    }

    if (dropdownLogoutButton) {
        dropdownLogoutButton.addEventListener("click", function (event) {
            event.preventDefault();
            if (typeof Swal !== "undefined") {
                window.Swal.fire({
                    title: "Are you sure you want to logout?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, logout",
                    cancelButtonText: "Cancel",
                    customClass: {
                        confirmButton:
                            "bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 mx-2 cursor-pointer",
                        cancelButton:
                            "bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200 mx-2 cursor-pointer",
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        const logoutForm =
                            document.getElementById("logout-form");
                        if (logoutForm) {
                            const logoutAction =
                                logoutForm.getAttribute("data-action") || "";
                            if (logoutAction) {
                                window.axios
                                    .delete(logoutAction)
                                    .then((response) => {
                                        if (
                                            response.data &&
                                            response.data.status === "success"
                                        ) {
                                            const redirectUrl =
                                                logoutForm.getAttribute(
                                                    "data-redirect"
                                                ) || "/";
                                            window.location.href = redirectUrl;
                                        }
                                    });
                            }
                        }
                    }
                });
            } else {
                const logoutForm = document.getElementById("logout-form");
                if (logoutForm) {
                    const logoutAction =
                        logoutForm.getAttribute("data-action") || "";
                    if (logoutAction) {
                        window.axios.delete(logoutAction).then((response) => {
                            if (
                                response.data &&
                                response.data.status === "success"
                            ) {
                                const redirectUrl =
                                    logoutForm.getAttribute("data-redirect") ||
                                    "/";
                                window.location.href = redirectUrl;
                            }
                        });
                    }
                }
            }
        });
    }
});

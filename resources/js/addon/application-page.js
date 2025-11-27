document.addEventListener("DOMContentLoaded", function () {
    function showNotification(message, type = "success") {
        if (typeof window.Toast !== "undefined") {
            window.Toast.fire({
                icon: type,
                title: message,
            });
        } else {
            alert(message);
        }
    }

    const headers = document.querySelector(
        "header[data-maintenance-url][data-success][data-error]"
    );
    if (headers) {
        const successMessage = headers.getAttribute("data-success");
        if (successMessage) {
            showNotification(successMessage, "success");
        }

        const errorMessage = headers.getAttribute("data-error");
        if (errorMessage) {
            showNotification(errorMessage, "error");
        }

        const maintenanceUrl = headers.getAttribute("data-maintenance-url");
        const csrfToken =
            document
                .querySelector('meta[property="csrf-token"]')
                .getAttribute("content") || "";

        if (typeof window.Swal !== "undefined") {
            const maintenanceBtn = document.getElementById("maintenance-btn");
            maintenanceBtn.addEventListener("click", function () {
                Swal.fire({
                    title: "Enter Secret Key",
                    input: "password",
                    inputLabel: "Secret Key",
                    inputPlaceholder: "Enter your secret key",
                    showCancelButton: true,
                    confirmButtonColor: "#F98825",
                    cancelButtonColor: "#d33",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const secretKey = result.value;
                        if (!secretKey) {
                            showNotification(
                                "Secret key is required.",
                                "error"
                            );
                            return;
                        }

                        fetch(maintenanceUrl, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            body: JSON.stringify({ secret: secretKey }),
                        })
                            .then((response) => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error(
                                        "Network response was not ok"
                                    );
                                }
                            })
                            .then((data) => {
                                showNotification(data.message, "success");
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            })
                            .catch((error) => {
                                showNotification(
                                    "Failed to toggle maintenance mode: " +
                                        error.message,
                                    "error"
                                );
                            });
                    }
                });
            });
        } else {
            showNotification("SweetAlert2 is not loaded.", "error");
        }
    }

    function previewFile(input, previewId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    const appLogoInput = document.getElementById("app_logo");
    if (appLogoInput) {
        appLogoInput.addEventListener("change", function () {
            previewFile(this, "app_logo_preview");
        });
    }

    const appFaviconInput = document.getElementById("app_favicon");
    if (appFaviconInput) {
        appFaviconInput.addEventListener("change", function () {
            previewFile(this, "app_favicon_preview");
        });
    }
});

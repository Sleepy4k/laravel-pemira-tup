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
        "header[data-success][data-error]"
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
    }
});

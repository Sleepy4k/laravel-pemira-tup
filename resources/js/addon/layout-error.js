document.addEventListener("DOMContentLoaded", function () {
    const backBtn = document.getElementById("back-btn");
    if (backBtn) {
        const previousUrl = backBtn.getAttribute("data-href");
        if (!previousUrl || previousUrl !== window.location.href) {
            backBtn.style.display = "block";
        }

        backBtn.addEventListener("click", function () {
            const href = this.getAttribute("data-href");
            if (href) {
                window.location.href = href;
            } else {
                window.history.back();
            }
        });
    }

    const homeBtn = document.getElementById("home-btn");
    if (homeBtn) {
        homeBtn.addEventListener("click", function () {
            const href = this.getAttribute("data-href");
            window.location.href = href;
        });
    }

    const retryBtn = document.getElementById("retry-btn");
    if (retryBtn) {
        retryBtn.addEventListener("click", function () {
            window.location.reload();
        });
    }

    const timestamp = document.getElementById("timestamp");
    if (timestamp) {
        setInterval(function () {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, "0");
            const day = String(now.getDate()).padStart(2, "0");
            const hours = String(now.getHours()).padStart(2, "0");
            const minutes = String(now.getMinutes()).padStart(2, "0");
            const seconds = String(now.getSeconds()).padStart(2, "0");
            timestamp.textContent = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }, 1000);
    }
});

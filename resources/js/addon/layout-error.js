document.addEventListener("DOMContentLoaded", function () {
    const homeBtn = document.getElementById("home-btn");
    if (homeBtn) {
        homeBtn.addEventListener("click", function () {
            const href = this.getAttribute("data-href");
            window.location.href = href;
        });
    }
});

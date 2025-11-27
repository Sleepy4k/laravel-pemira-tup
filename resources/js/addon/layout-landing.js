document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        const refreshAnimation = document.querySelector(".refresh-animation");
        if (refreshAnimation) {
            refreshAnimation.style.display = "none";
        }
    }, 3000);

    const loginButton = document.getElementById("login-button");
    if (loginButton) {
        loginButton.addEventListener("click", function () {
            const redirectUrl = loginButton.getAttribute("data-redirect");
            if (redirectUrl) {
                window.location.href = redirectUrl;
            }
        });
    }

    const dashboardButton = document.getElementById("dashboard-button");
    if (dashboardButton) {
        dashboardButton.addEventListener("click", function () {
            const redirectUrl = dashboardButton.getAttribute("data-redirect");
            if (redirectUrl) {
                window.location.href = redirectUrl;
            }
        });
    }

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

    const voteBtn = document.querySelectorAll("#vote-button");
    if (voteBtn) {
        voteBtn.forEach(button => {
            button.addEventListener("click", function () {
                const redirectUrl = button.getAttribute("data-redirect");
                if (redirectUrl) {
                    window.location.href = redirectUrl;
                }
            });
        });
    }
});

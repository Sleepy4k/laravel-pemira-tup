document.addEventListener("DOMContentLoaded", function () {
    const questions = document.querySelectorAll(".faq-question");
    if (questions.length) {
        questions.forEach((question) => {
            question.addEventListener("click", function () {
                const faqItem = this.parentElement;
                const isActive = faqItem.classList.contains("active");
                const items = document.querySelectorAll(".faq-item");

                if (items.length) {
                    items.forEach((item) => {
                        item.classList.remove("active");
                    });
                }

                if (!isActive) {
                    faqItem.classList.add("active");
                }
            });
        });
    }

    const viewCandidatesBtn = document.getElementById("view-candidates-btn");
    if (viewCandidatesBtn) {
        viewCandidatesBtn.addEventListener("click", function () {
            const redirectUrl = viewCandidatesBtn.getAttribute("data-redirect");
            if (redirectUrl) {
                window.location.href = redirectUrl;
            }
        });
    }
});

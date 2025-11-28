document.addEventListener("DOMContentLoaded", function () {
    const tl = gsap.timeline({ defaults: { ease: "power2.out", duration: 1 } });

    tl.from("main section:first-child img", {
        scale: 0.5,
        opacity: 0,
        duration: 1.5,
        ease: "back.out(1.7)",
    })
        .from(
            "main h1",
            {
                y: 30,
                opacity: 0,
                duration: 0.8,
            },
            "-=0.8"
        )
        // Animate each FAQ item
        .from(
            ".faq-item",
            {
                y: 20,
                opacity: 0,
                stagger: 0.2, // Stagger the animation for each item
            },
            "-=0.6"
        );

    // FAQ Accordion Functionality
    const faqItems = document.querySelectorAll(".faq-item");

    if (faqItems) {
        faqItems.forEach((item) => {
            const question = item.querySelector(".faq-question");
            const answer = item.querySelector(".faq-answer");

            answer.style.maxHeight = "0px";

            question.addEventListener("click", () => {
                if (answer.classList.contains("max-h-0")) {
                    answer.classList.remove("max-h-0");
                    answer.style.maxHeight = answer.scrollHeight + "px";
                } else {
                    answer.style.maxHeight = "0px";
                    answer.classList.add("max-h-0");
                }

                // rotate the icon
                const icon = question.querySelector("box-icon");
                if (icon) {
                    if (icon.classList.contains("rotate-0")) {
                        icon.classList.remove("rotate-0");
                        icon.classList.add("rotate-180");
                    } else {
                        icon.classList.remove("rotate-180");
                        icon.classList.add("rotate-0");
                    }
                }
            });
        });
    }
});

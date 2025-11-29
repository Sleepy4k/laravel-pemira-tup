document.addEventListener("DOMContentLoaded", () => {
    const masterTl = gsap.timeline({ defaults: { ease: "power3.out" } });

    masterTl
        .to("#info-card", {
            autoAlpha: 1, // GSAP's special property for visibility + opacity
            duration: 0,
        })
        .from("#info-card", {
            y: -50,
            opacity: 0,
            duration: 1.5,
            ease: "back.out(1.5)", // Bounce effect
        })
        // Animate children with class .stagger-item
        .from(
            ".stagger-item",
            {
                y: 20,
                opacity: 0,
                duration: 0.8,
                stagger: 0.3, // Time between each item appearing
            },
            "-=0.8"
        );

    gsap.set(".voting-type-card", { autoAlpha: 1 });

    gsap.from(".voting-type-card", {
        scrollTrigger: {
            trigger: ".voting-type-grid",
            start: "top 85%", // Start animation when top of grid hits 85% of viewport
            toggleActions: "play none none reverse", // Play on enter, reverse on leave
        },
        y: 60,
        opacity: 0,
        duration: 0.8,
        stagger: 0.5, // Delay between each card
        ease: "power2.out",
    });

    if (!document.querySelector(".voting-type-card")) {
        gsap.from(".voting-type-grid > div", {
            y: 30,
            opacity: 0,
            duration: 0.5,
            delay: 0.5,
            ease: "power2.out",
        });
    }

    function showNotification(message, type = "info") {
        if (typeof window.Toast !== "undefined") {
            Toast.fire({
                icon: type,
                title: message,
            });
        } else {
            alert(message);
        }
    }

    // Check for success or error messages in the header data attributes
    const header = document.querySelector(
        "header-meta[data-success], header-meta[data-error]"
    );
    if (header) {
        const successMessage = header.getAttribute("data-success");
        const errorMessage = header.getAttribute("data-error");

        if (successMessage) {
            showNotification(successMessage, "success");
        }

        if (errorMessage) {
            showNotification(errorMessage, "error");
        }
    }
});

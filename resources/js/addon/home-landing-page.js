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
        .from(
            "main .bg-brand-accent",
            {
                width: 0,
                duration: 0.8,
                ease: "power2.inOut",
            },
            "-=0.6"
        )
        .from(
            "main p",
            {
                y: 20,
                opacity: 0,
            },
            "-=0.6"
        );

    // This makes the ballot box move up and down gently forever
    gsap.to("main section:nth-child(2) img", {
        y: -15, // Move up 15px
        duration: 2,
        yoyo: true, // Go back down
        repeat: -1, // Repeat infinite
        ease: "sine.inOut", // Smooth sine wave movement
    });

    // The card slides up when the user scrolls to it
    gsap.from("main section:nth-child(2) > div", {
        scrollTrigger: {
            trigger: "main section:nth-child(2)", // The section containing the card
            start: "top 80%", // Animation starts when top of section hits 80% of viewport height
            toggleActions: "play none none reverse", // Play on enter, reverse on leave
        },
        y: 100, // Start 100px lower
        opacity: 0,
        duration: 1,
        ease: "power3.out",
    });
});

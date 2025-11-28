document.addEventListener('DOMContentLoaded', () => {
    // create a gsap timeline
    const tl = gsap.timeline({ defaults: { ease: "power1.out" } });

    // animate the info card
    tl.fromTo('#info-card', { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 0.6 });

    // animate stagger items
    tl.fromTo('.stagger-item',
        { y: 20, opacity: 0 },
        { y: 0, opacity: 1, duration: 0.4, stagger: 0.2 },
        "-=0.3" // overlap with previous animation
    );

    // animate the voting type cards
    tl.fromTo('.voting-type-card',
        { y: 50, opacity: 0, scale: 0.9 },
        { y: 0, opacity: 1, scale: 1, duration: 0.8, ease: "back.out(1.7)", stagger: 0.2 },
        "-=0.2" // overlap with previous animation
    );

    tl.fromTo('.cta-button',
        { scale: 0.8, opacity: 0 },
        { scale: 1, opacity: 1, duration: 0.5 },
        "-=0.4" // overlap with previous animation
    );
});

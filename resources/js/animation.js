/**
 * New Electric — Room Power-Up Animation
 * Uses GSAP + ScrollTrigger for the homepage hero.
 */

// Respect prefers-reduced-motion
if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    // Static fallback: just fade in the hero
    const hero = document.getElementById('room-animation-hero');
    if (hero) {
        hero.style.opacity = '0';
        hero.style.transition = 'opacity 0.6s ease';
        requestAnimationFrame(() => { hero.style.opacity = '1'; });
    }
} else {
    import('gsap').then(({ gsap }) => {
        import('gsap/ScrollTrigger').then(({ ScrollTrigger }) => {
            gsap.registerPlugin(ScrollTrigger);

            const isMobile = window.innerWidth < 768;

            if (isMobile) {
                // Simple stagger fade-in on mobile — no pinning
                gsap.from(['#bulb', '#fan-blades', '#led-strip', '#wall-switch'], {
                    opacity: 0,
                    y: 20,
                    stagger: 0.2,
                    duration: 0.6,
                    ease: 'power2.out',
                });
            } else {
                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: '#room-animation-hero',
                        start: 'top top',
                        end: '+=150%',
                        pin: true,
                        scrub: 0.5,
                    },
                });

                // Bulb: glow effect
                tl.to('#bulb circle', {
                    fill: '#fbbf24',
                    filter: 'drop-shadow(0 0 20px #fbbf24)',
                    duration: 1,
                    ease: 'power2.inOut',
                });

                // Fan: spin
                tl.to('#fan-blades', {
                    rotation: 360,
                    transformOrigin: '600px 150px',
                    duration: 1.5,
                    repeat: 1,
                    ease: 'none',
                }, '-=0.3');

                // LED strip: reveal
                tl.from('#led-strip rect', {
                    scaleX: 0,
                    transformOrigin: 'left center',
                    duration: 1,
                    ease: 'power2.out',
                }, '-=0.5');

                // Switch toggle
                tl.to('#wall-switch rect:last-child', {
                    y: -10,
                    fill: '#fbbf24',
                    duration: 0.3,
                }, '-=0.3');
            }
        });
    });
}

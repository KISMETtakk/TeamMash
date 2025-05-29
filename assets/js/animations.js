// Advanced animations and interactive effects
class AnimationController {
    constructor() {
        this.init();
    }

    init() {
        this.setupScrollAnimations();
        this.setupParallaxEffects();
        this.setupHoverEffects();
        this.setupLoadingAnimations();
        this.setupTypewriterEffect();
    }

    setupScrollAnimations() {
        // Create intersection observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.triggerAnimation(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements with animation classes
        const animatedElements = document.querySelectorAll(`
            .fade-in-on-scroll,
            .slide-in-left-on-scroll,
            .slide-in-right-on-scroll,
            .scale-in-on-scroll,
            .impact-card,
            .endorsement-item
        `);

        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }

    triggerAnimation(element) {
        if (element.classList.contains('fade-in-on-scroll')) {
            element.style.animation = 'fadeIn 0.8s ease-out forwards';
        } else if (element.classList.contains('slide-in-left-on-scroll')) {
            element.style.animation = 'slideInLeft 0.8s ease-out forwards';
        } else if (element.classList.contains('slide-in-right-on-scroll')) {
            element.style.animation = 'slideInRight 0.8s ease-out forwards';
        } else if (element.classList.contains('scale-in-on-scroll')) {
            element.style.animation = 'scaleIn 0.6s ease-out forwards';
        } else if (element.classList.contains('impact-card')) {
            element.style.animation = 'bounceIn 0.8s ease-out forwards';
        } else if (element.classList.contains('endorsement-item')) {
            element.style.animation = 'fadeIn 0.6s ease-out forwards';
        }

        element.classList.add('animated');
    }

    setupParallaxEffects() {
        const parallaxElements = document.querySelectorAll('.parallax');
        
        if (parallaxElements.length === 0) return;

        let ticking = false;

        const updateParallax = () => {
            const scrollTop = window.pageYOffset;

            parallaxElements.forEach(element => {
                const speed = parseFloat(element.dataset.speed) || 0.5;
                const yPos = -(scrollTop * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });

            ticking = false;
        };

        const requestParallaxUpdate = () => {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        };

        window.addEventListener('scroll', requestParallaxUpdate);
    }

    setupHoverEffects() {
        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('click', this.createRipple);
        });

        // Add hover animations to cards
        const cards = document.querySelectorAll('.impact-card, .endorsement-item');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px) scale(1.02)';
                card.style.boxShadow = '0 15px 30px rgba(0,0,0,0.15)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
                card.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            });
        });

        // Add floating animation to icons
        const icons = document.querySelectorAll('.impact-icon');
        icons.forEach((icon, index) => {
            icon.style.animationDelay = `${index * 0.2}s`;
            icon.classList.add('animate-float');
        });
    }

    createRipple(event) {
        const button = event.currentTarget;
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;

        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;

        // Add ripple keyframes if not already added
        if (!document.querySelector('#ripple-styles')) {
            const style = document.createElement('style');
            style.id = 'ripple-styles';
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        button.style.position = 'relative';
        button.style.overflow = 'hidden';
        button.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    setupLoadingAnimations() {
        // Stagger animation for lists
        const lists = document.querySelectorAll('.stagger-animation');
        lists.forEach(list => {
            const items = list.children;
            Array.from(items).forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
                item.classList.add('animate-fade-in');
            });
        });

        // Progress bar animation
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.dataset.width || '100%';
            setTimeout(() => {
                bar.style.width = width;
            }, 500);
        });
    }

    setupTypewriterEffect() {
        const typewriterElements = document.querySelectorAll('.typewriter');
        
        typewriterElements.forEach(element => {
            const text = element.textContent;
            element.textContent = '';
            element.style.borderRight = '2px solid var(--secondary-color)';
            
            let i = 0;
            const typeInterval = setInterval(() => {
                if (i < text.length) {
                    element.textContent += text.charAt(i);
                    i++;
                } else {
                    clearInterval(typeInterval);
                    // Blinking cursor effect
                    setInterval(() => {
                        element.style.borderColor = element.style.borderColor === 'transparent' 
                            ? 'var(--secondary-color)' 
                            : 'transparent';
                    }, 500);
                }
            }, 100);
        });
    }

    // Method to animate counters with easing
    animateCounter(element, target, duration = 2000) {
        const start = 0;
        const startTime = performance.now();
        
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function (ease-out)
            const easeOut = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(start + (target - start) * easeOut);
            
            element.textContent = current + (element.textContent.includes('+') ? '+' : '');
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };
        
        requestAnimationFrame(animate);
    }

    // Method to create particle effects
    createParticles(container, count = 50) {
        for (let i = 0; i < count; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.cssText = `
                position: absolute;
                width: 4px;
                height: 4px;
                background: var(--secondary-color);
                border-radius: 50%;
                pointer-events: none;
                opacity: 0.7;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                animation: float ${3 + Math.random() * 4}s ease-in-out infinite;
                animation-delay: ${Math.random() * 2}s;
            `;
            container.appendChild(particle);
        }
    }

    // Method to add scroll-triggered animations
    addScrollTrigger(element, animationClass, offset = 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add(animationClass);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: `0px 0px ${offset}px 0px`
        });

        observer.observe(element);
    }

    // Method to create smooth page transitions
    setupPageTransitions() {
        const links = document.querySelectorAll('a[href^="/"], a[href^="./"], a[href^="../"]');
        
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                if (link.hostname !== window.location.hostname) return;
                
                e.preventDefault();
                
                // Add exit animation
                document.body.style.animation = 'fadeOut 0.3s ease-out';
                
                setTimeout(() => {
                    window.location.href = link.href;
                }, 300);
            });
        });
    }

    // Method to handle form animations
    setupFormAnimations() {
        const formGroups = document.querySelectorAll('.form-group');
        
        formGroups.forEach((group, index) => {
            group.style.opacity = '0';
            group.style.transform = 'translateY(20px)';
            group.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            group.style.transitionDelay = `${index * 0.1}s`;
            
            setTimeout(() => {
                group.style.opacity = '1';
                group.style.transform = 'translateY(0)';
            }, 100);
        });

        // Add focus animations to form inputs
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentNode.classList.add('focused');
            });
            
            input.addEventListener('blur', () => {
                if (!input.value) {
                    input.parentNode.classList.remove('focused');
                }
            });
        });
    }
}

// Initialize animations when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AnimationController();
});

// Add CSS for additional animations
const additionalStyles = `
    .particle {
        z-index: -1;
    }
    
    .form-group.focused label {
        color: var(--secondary-color);
        transform: translateY(-5px);
        font-size: 0.9rem;
    }
    
    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
    
    .animated {
        animation-fill-mode: both;
    }
`;

// Inject additional styles
const styleSheet = document.createElement('style');
styleSheet.textContent = additionalStyles;
document.head.appendChild(styleSheet);
/**
 * GP Advanced Logo System - JavaScript Enhancement
 * Provides interactive features and performance optimizations
 */

(function($) {
    'use strict';

    class GP_Logo_System {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
            this.optimizeLogoLoading();
            this.setupLogoAnimation();
        }

        bindEvents() {
            // Logo hover effects
            $(document).on('mouseenter', '.gp-logo-link', this.handleLogoHover.bind(this));
            $(document).on('mouseleave', '.gp-logo-link', this.handleLogoLeave.bind(this));

            // Logo click tracking (optional analytics)
            $(document).on('click', '.gp-logo-link', this.handleLogoClick.bind(this));

            // Window resize for responsive adjustments
            $(window).on('resize', this.debounce(this.handleResize.bind(this), 250));

            // Logo lazy loading optimization
            this.setupIntersectionObserver();
        }

        handleLogoHover(e) {
            const $logo = $(e.currentTarget);
            const $image = $logo.find('.gp-logo-image');

            // Add hover class for CSS animations
            $logo.addClass('logo-hover-active');

            // Preload hover state if needed
            if ($image.length && !$image.hasClass('loaded')) {
                $image.addClass('loaded');
            }
        }

        handleLogoLeave(e) {
            const $logo = $(e.currentTarget);
            $logo.removeClass('logo-hover-active');
        }

        handleLogoClick(e) {
            // Optional: Add click tracking
            if (typeof gtag !== 'undefined') {
                gtag('event', 'logo_click', {
                    'event_category': 'engagement',
                    'event_label': 'header_logo'
                });
            }
        }

        handleResize() {
            // Adjust logo sizing on resize if needed
            this.adjustLogoSizing();
        }

        adjustLogoSizing() {
            const $logos = $('.gp-advanced-logo');

            $logos.each(function() {
                const $logo = $(this);
                const $image = $logo.find('.gp-logo-image');
                const containerHeight = $logo.height();

                if ($image.length && containerHeight > 0) {
                    // Ensure logo fits within container
                    $image.css('max-height', containerHeight + 'px');
                }
            });
        }

        optimizeLogoLoading() {
            // Preload critical logo assets
            const $logos = $('.gp-logo-image');

            $logos.each(function() {
                const $img = $(this);
                const src = $img.attr('src');

                if (src) {
                    // Create a preload link for critical logos
                    if ($img.closest('.header-logo-section').length) {
                        const preloadLink = document.createElement('link');
                        preloadLink.rel = 'preload';
                        preloadLink.href = src;
                        preloadLink.as = 'image';
                        document.head.appendChild(preloadLink);
                    }
                }
            });
        }

        setupLogoAnimation() {
            // Add CSS class for initial load animation
            $(document).ready(function() {
                $('.gp-advanced-logo').addClass('logo-loaded');

                // Stagger animation for multiple logos
                $('.gp-advanced-logo').each(function(index) {
                    const $logo = $(this);
                    setTimeout(function() {
                        $logo.addClass('logo-animated');
                    }, index * 100);
                });
            });
        }

        setupIntersectionObserver() {
            // Use Intersection Observer for performance
            if ('IntersectionObserver' in window) {
                const logoObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const $logo = $(entry.target);
                            $logo.addClass('logo-in-viewport');

                            // Stop observing once loaded
                            logoObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    rootMargin: '50px'
                });

                // Observe all logos
                document.querySelectorAll('.gp-advanced-logo').forEach(logo => {
                    logoObserver.observe(logo);
                });
            }
        }

        // Utility function for debouncing
        debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
    }

    // Initialize when DOM is ready
    $(document).ready(function() {
        new GP_Logo_System();
    });

    // Also initialize on page load for dynamic content
    $(window).on('load', function() {
        // Re-initialize for any dynamically loaded logos
        if (typeof GP_Logo_System !== 'undefined') {
            new GP_Logo_System();
        }
    });

})(jQuery);
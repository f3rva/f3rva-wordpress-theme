/**
 * F3RVA Theme Scripts
 * 
 * @package F3RVA
 * @since 1.0.0
 */

(function() {
    'use strict';

    // Mobile menu toggle functionality
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const mainNav = document.querySelector('#primary-menu');
        
        if (!menuToggle || !mainNav) {
            return;
        }

        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            
            if (isExpanded) {
                mainNav.style.display = 'none';
                menuToggle.classList.remove('active');
            } else {
                mainNav.style.display = 'block';
                menuToggle.classList.add('active');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && !mainNav.contains(e.target)) {
                mainNav.style.display = 'none';
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.classList.remove('active');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                mainNav.style.display = '';
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.classList.remove('active');
            }
        });
    }

    // Smooth scrolling for anchor links
    function initSmoothScrolling() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Add focus styles for keyboard navigation
    function initAccessibility() {
        // Add focus-visible polyfill behavior
        function onPointerDown() {
            document.body.classList.add('using-mouse');
        }

        function onKeyDown(e) {
            if (e.metaKey || e.altKey || e.ctrlKey) {
                return;
            }
            document.body.classList.remove('using-mouse');
        }

        document.addEventListener('pointerdown', onPointerDown);
        document.addEventListener('keydown', onKeyDown);
    }

    // Initialize when DOM is ready
    function init() {
        initMobileMenu();
        initSmoothScrolling();
        initAccessibility();
    }

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
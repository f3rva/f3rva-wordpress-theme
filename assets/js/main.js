/**
 * F3 RVA Theme JavaScript
 *
 * @package F3RVA
 * @since 1.0.0
 */

(function() {
    'use strict';
    
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        var menuToggle = document.querySelector('.menu-toggle');
        var navigation = document.querySelector('.main-navigation');
        var menu = document.querySelector('#primary-menu');
        
        if (menuToggle && menu) {
            menuToggle.addEventListener('click', function() {
                var expanded = menuToggle.getAttribute('aria-expanded') === 'true';
                menuToggle.setAttribute('aria-expanded', !expanded);
                menu.classList.toggle('toggled');
                navigation.classList.toggle('toggled');
            });
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (menu && menu.classList.contains('toggled')) {
                if (!navigation.contains(event.target)) {
                    menu.classList.remove('toggled');
                    navigation.classList.remove('toggled');
                    if (menuToggle) {
                        menuToggle.setAttribute('aria-expanded', 'false');
                    }
                }
            }
        });
        
        // Smooth scrolling for anchor links
        var anchorLinks = document.querySelectorAll('a[href*="#"]');
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                var href = this.getAttribute('href');
                var target = document.querySelector(href);
                
                if (target && href.startsWith('#')) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Skip link focus fix
        var skipLink = document.querySelector('.skip-link');
        if (skipLink) {
            skipLink.addEventListener('click', function() {
                var target = document.querySelector(skipLink.getAttribute('href'));
                if (target) {
                    target.focus();
                }
            });
        }
    });
    
})();
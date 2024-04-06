/*
Theme Name: Corporafun
Text Domain: Coroprafun
Version: 1.0
Description: corporate fun
Author: Bootstrap
Author URI: https://getbootstrap.com/
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
});

window.onload = function() {
    var titles = document.querySelectorAll('.tab-item-title');
    titles.forEach(title => {
        resizeText(title);
    });
};

function resizeText(element) {
    var maxWidth = element.offsetWidth;
    var currentSize = parseFloat(window.getComputedStyle(element, null).getPropertyValue('font-size'));
    while (element.scrollWidth > maxWidth && currentSize > 10) {
        currentSize -= 1;
        element.style.fontSize = currentSize + 'px';
        if (currentSize <= 10) break; // Avoids excessively small font
    }
}
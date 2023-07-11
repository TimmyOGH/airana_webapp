// Update logo text dynamically on window resize and page load
window.addEventListener('DOMContentLoaded', function () {
    const logoText = document.getElementById('logo_text');
    updateLogoText(logoText);

    window.addEventListener('resize', function () {
        updateLogoText(logoText);
    });
});

function updateLogoText(logoText) {
    if (window.innerWidth <= 648) {
        logoText.textContent = 'A';
    } else {
        logoText.textContent = 'airana';
    }
}

// show/hide footer with animation
var lastScrollTop = 0;
var footer = document.querySelector('footer');

function hideFooter() {
    footer.classList.add('hidden');
}

function showFooter() {
    footer.classList.remove('hidden');
}

function handleScroll() {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        hideFooter();
    } else {
        showFooter();
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For mobile or negative scrolling
}

window.addEventListener('scroll', function () {
    handleScroll();
});

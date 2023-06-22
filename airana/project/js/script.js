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

// show/hide edit register pop-up
function toggleRegisterPopUp() {
    var reg_popup = document.querySelector('.reg_popup');
    reg_popup.classList.toggle('active');
}

// show/hide edit login pop-up
function toggleLoginPopUp() {
    var login_popup = document.querySelector('.login_popup');
    login_popup.classList.toggle('active');
}

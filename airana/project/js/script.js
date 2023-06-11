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

const reg_popup = document.getElementById("reg_popup");

function showRegisterPopUp() {
    reg_popup.style.display = "block";
}

function hideRegisterPopUp() {
    reg_popup.style.display = "none";
}

const login_popup = document.getElementById("login_popup");

function showLoginPopUp() {
    login_popup.style.display = "block";
}

function hideLoginPopUp() {
    login_popup.style.display = "none";
}
import { reservations } from './vacation_house.js';

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

// display catalogue
const catalogContainer = document.getElementById("catalog-container");

reservations.forEach(reservation => {
    const panel = document.createElement("div");
    panel.className = "panel";

    const link = document.createElement("a");
    link.href = "../php/reserve.php";

    const image = document.createElement("img");
    image.src = reservation.photo;
    image.alt = "Vacation Photo";
    link.appendChild(image);

    const title = document.createElement("h3");
    title.textContent = reservation.name;
    link.appendChild(title);

    const date = document.createElement("p");
    date.textContent = reservation.dateRange;
    link.appendChild(date);

    const rating = document.createElement("p");
    rating.className = "rating";
    rating.textContent = "★" + reservation.rating.toFixed(1);

    link.appendChild(rating);

    const price = document.createElement("p");
    price.textContent = reservation.price;
    link.appendChild(price);

    panel.appendChild(link);
    catalogContainer.appendChild(panel);
});

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

// update year dynamically
var year = document.getElementById('year');
year.innerHTML = new Date().getFullYear();

// show/hide pop-up
function toggleAddAdminPopUp() {
    var overlay = document.querySelector('.overlay');
    overlay.classList.toggle('active');
}

// handle form submission
function addAdmin() {
    toggleAddAdminPopUp();
}
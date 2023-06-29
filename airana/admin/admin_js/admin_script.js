// show/hide add admin pop-up
function toggleAddAdminPopUp() {
    var add_admin_overlay = document.querySelector('.add_admin_overlay');
    add_admin_overlay.classList.toggle('active');
}

// show/hide edit admin pop-up
function toggleEditAdminPopUp() {
    var edit_admin_overlay = document.querySelector('.edit_admin_overlay');
    edit_admin_overlay.classList.toggle('active');
}

// show/hide delete admin pop-up
function toggleDeleteAdminPopUp() {
    var delete_admin_overlay = document.querySelector('.delete_admin_overlay');
    delete_admin_overlay.classList.toggle('active');
}

// hide admin login pop up & remove blur effect
function hideAdminLoginPopUp() {
    var adminLoginContainer = document.getElementById('admin-login-container');
    adminLoginContainer.style.display = 'none';
}

// Check if user is logged in using php session
var loggedIn = "<?php echo isset($_SESSION['adminLoggedIn']) && $_SESSION['adminLoggedIn'] ? 'true' : 'false'; ?>";

if (loggedIn === 'true') {
    hideAdminLoginPopUp();
}

//changing background after choosing file
function changeBackground(event, targetId) {
    var div = document.getElementById(targetId);
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
        div.style.backgroundImage = "url('" + e.target.result + "')";
    }

    reader.readAsDataURL(file);
}


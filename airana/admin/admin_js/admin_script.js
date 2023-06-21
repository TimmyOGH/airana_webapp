// show/hide pop-up
function toggleAddAdminPopUp() {
    var overlay = document.querySelector('.overlay');
    overlay.classList.toggle('active');
}

// handle form submission
function addAdmin() {
    toggleAddAdminPopUp();
}

//changing background after choosing file
function changeBackground(event, targetId) {
    var div = document.getElementById(targetId);
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
    div.style.backgroundImage = "url('" + e.target.result + "')";
    }

    reader.readAsDataURL(file);
}

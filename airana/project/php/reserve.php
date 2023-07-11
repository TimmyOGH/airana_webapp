<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>airana</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=Instrument+Sans&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <h4><a id="logo_text" href="../html/main.html">airana</a></h4>
        </div>
        <div class="search-box">
            <input class="search-input" type="text" placeholder="Search">
            <button class="search-btn"><i class="fa fa-search"></i></button>
        </div>
        <div class="menu-container">
            <div class="menu-profile">
                <div class="dropdown">
                    <img class="burger_img" src="../images/hamburger_menu.png" alt="hamburger_menu" width="25"
                        height="25">
                    <img class="profile_img" src="../images/user_icon.jpeg" alt="user_icon" width="35" height="35">
                    <div class="dropdown-content">
                        <?php
                            session_start();
                            if ($_SESSION['loginSuccess'] === true || $_SESSION['registerSuccess'] === true) {
                                echo "<a href='logout.php'>Logout</a>";
                            } else {
                                echo "<a href='../html/register.html'>Register</a>";
                                echo "<a href='../html/login.html'>Login</a>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Footer -->
    <footer>
        <p>&copy;<span class="year"></span> Airana, Inc.</p>
        <p><a href="term.html">Terms</a></p>
        <p><a href="privacy.html">Privacy</a></p>
        <p><a href="contact_us.html">Contact Us</a></p>
        <div class="social-icons">
            <a href="https://www.facebook.com/"><img src="../images/facebook.png" alt="facebook" height="30px"></a>
            <a href="https://www.instagram.com/"><img src="../images/instagram.png" alt="instagram" height="30px"></a>
            <a href="https://twitter.com/"><img src="../images/twitter.png" alt="twitter" height="30px"></a>
        </div>
    </footer>

    <script>
        // update year dynamically
        var year = document.querySelector('.year');
        year.innerHTML = new Date().getFullYear();
    </script>

    <script src="../js/script.js"></script>
</body>

</html>

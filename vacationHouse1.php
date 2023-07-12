<!--
    Things to update>>
    - Calculating prices based on how many days the customer is going to stay.
    - Put total price within form.
    - 
-->

<?php
// Linking to database
$servername = "localhost";
$username = "root";
$password = "moelay123";
$dbname = "airanaDB";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// If connection is failed
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Calculating average rating from all of the reviews
$sqlAvgRating = "SELECT AVG(rating) AS avg_rating FROM reviews";
$resultAvgRating = mysqli_query($conn, $sqlAvgRating);
$rowAvgRating = mysqli_fetch_assoc($resultAvgRating);
$averageRating = $rowAvgRating['avg_rating'];

// Calculating total number of reviews
$sqlTotalReviews = "SELECT COUNT(*) AS total_reviews FROM reviews";
$resultTotalReviews = mysqli_query($conn, $sqlTotalReviews);
$rowTotalReviews = mysqli_fetch_assoc($resultTotalReviews);
$totalReviews = $rowTotalReviews['total_reviews'];
?>

<!--PHP for review form and reservation form-->
<?php
session_start();

// If the user submitted a reservation form
if (isset($_POST['username'], $_POST['rating'], $_POST['review'])) {
    // If the user is not logged in yet,
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page without saving new reservation in database
        header("Location: ../html/login.html");
        exit();
    } else {
        //If the user has logged in and submitted a reservation,
        if (isset($_POST['submit'])) {
            // save the data to database
            $vhid = 1;
            $startDate = $_POST['startDatePicker'];
            $endDate = $_POST['endDatePicker'];
            $guests = $_POST['guests'];
            $price = 44.00;

            // Formatting the date to be able to store in database
            $formattedStartDate = date('Y-m-d', strtotime($startDate));
            $formattedEndDate = date('Y-m-d', strtotime($endDate));

            // Inserting data into reservations table
            $sql = "INSERT INTO reservations (vhid, startDate, endDate, guests, price) VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isssd", $vhid, $formattedStartDate, $formattedEndDate, $guests, $price);

            // Showing if the user has submitted successfully or not
            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Reserved successfully");</script>';
            } else {
                echo '<script>alert("Error: ' . $sql . ' \n' . mysqli_error($conn) . '");</script>';
            }

            // Statement Close
            mysqli_stmt_close($stmt);
        }
    }
}

// If the user submitted the review form
if (isset($_POST['submit'])) {
    // If the user is not logged in yet,
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page without saving new review in database
        header("Location: ../html/login.html");
        exit();
    } else {
        //If the user has logged in and submitted a review,
        if (isset($_POST['username'], $_POST['rating'], $_POST['review'])) {
            // save the data to database
            $username = $_POST['username'];
            $rating = $_POST['rating'];
            $review = $_POST['review'];

            //Inserting data into reviews table
            $sql = "INSERT INTO reviews (username, rating, review_text) VALUES (?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sis", $username, $rating, $review);

            // Showing if the user has submitted successfully or not
            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Review submitted successfully");</script>';
            } else {
                echo '<script>alert("Error: ' . $sql . ' \n' . mysqli_error($conn) . '");</script>';
            }

            // Statement Close
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cabana do Sossego</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/vacationHouse1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
    <header>Airana</header> <!--Header-->

    <main>
        <!--Vacation House Title-->
        <h1>Cabana do Sossego</h1>
        <p>★<?php echo $averageRating; ?> · <?php echo $totalReviews; ?> reviews · Balian Beach, Bali, Indonesia</p>

        <!--Slide Show-->
        <div class="slideshow-container">
            <div class="slide active">
                <img src="../images/Cabana_do_Sossego.png" alt="pic 1">
            </div>
            <div class="slide">
                <img src="../images/Cabana_do_Sossego2.png" alt="pic 2">
            </div>
            <div class="slide">
                <img src="../images/Cabana_do_Sossego3.png" alt="pic 3">
            </div>
        </div>

        <div class="slideshow_buttons">
            <button id="prev">&lt; &lt;</button>
            <button id="next">&gt; &gt;</button>
        </div>

        <!-- Description>> Optional -->
        <section class="description">
    
            Dedicated workspace
            <ul>
                <li>A common area with wifi that&apos;s well-suited for working.</li>
                <li>Self check-in</li>
                <li>You can check in with the doorman.</li>
                <li>Free cancellation for 48 hours.</li>
            </ul>

            The Balian treehouse is only a 3 minute walk away from the beach. From the veranda, you can watch the sunrise in the morning and enjoy the view of our beautiful garden (900m2) with a pool.
            <br> <br>
            <b>The space</b><br>
            We have several hangouts in our garden, and our pool is beautifully lit in the evening and turquoise in the daytime, just inviting you to jump in. Upstairs is the open living area. The lazy couch on the veranda overlooks the palm trees (TREEHOUSE), our beautiful garden, and pool, and has some ocean view as well. It's the perfect place to wake up and relax drinking your coffee or tea. You can enjoy a nice ocean breeze when you feel it's too warm to be outside in the sun or just when you feel the need to be nicely lazy. Inside, there is a big (180 x 240) daybed with a mosquito net if you need it. Downstairs, there is the bedroom, kitchenette, bathroom, and a second veranda. We have a rain shower with hot water, there is a standing fan and AC in the bedroom. In the bedroom, there is a Flatscreen TV with some channels and movies on demand. The TV has a USB plug so you could take your favorite movies or series to watch. We also have a DVD player. We use Indihome fiber for the quickest internet in Bali, so you can stream and download.
            When arriving at this lovely and special village, you immediately feel all the good Bali has to offer you. Balian is a small surfer/relax village; it feels like the older days in Bali.
            We built the house as green as possible with a lot of decoration found in nature, like the driftwood from the beach. I put a lot of blood, sweat, fun, and tears into building this house. We are always busy expanding and updating the house, which has to be done living near the ocean!!
            The night market is nearby and has plenty of nice local food for great prices.
            <br><br>
            <b>Guest access</b><br>
            There is a small dirt road that will take you to the beach/village in only a few minutes. We decided not to build a concrete wall around our garden; there is no need for that in a security way, and we don't like the feeling of being trapped (there are plenty of walls in the Seminyak area).
            There is still a lot of free land next to the house, and it's a 2 min walk down to the beautiful river.
            <br><br>
            <b>Other things to note</b><br>
            We normally live in this house ourselves, so I think you can feel the difference from renting a hotel room because of that.
        </section>


        <!-- Reservation Form -->
        <form class="reserve-form" method="POST" action="">

            <h3>$44 night</h3>
            <p>★<?php echo $averageRating; ?> · <?php echo $totalReviews; ?> reviews</p>
            <label for="check-in">CHECK-IN</label>
            <input type="text" id="startDatePicker" name="startDatePicker" required> <br>
            <label for="check-out">CHECK-OUT</label>
            <input type="text" id="endDatePicker" name="endDatePicker" required> <br>
            <label for="guests">GUESTS</label>
            <select id="guests" name="guests">
                <option value="1">1 guest</option>
                <option value="2">2 guests</option>
                <option value="3">3 guests</option>
                <option value="3">4 guests</option>
                <option value="3">5 guests</option>
            </select> <br>
            <button type="submit" name="submit" id="submit">Reserve</button>
            <p>You won't be charged yet <br>
                $44 x 5 nights - $222<br>
                Total before taxes - $222</p>
        </form>


        <!-- Review form-->
        <div class="review-form" method="POST">
            <h3>Add a Review</h3>
            <form action="" method="post">
                <label for="username">Your Name:</label>
                <input type="text" id="username" name="username" required><br>

                <label for="rating">Rating:</label>
                <select id="rating" name="rating" class="star-rating">
                    <option value="1">&#9733;</option>
                    <option value="2">&#9733;&#9733;</option>
                    <option value="3">&#9733;&#9733;&#9733;</option>
                    <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                </select> <br>

                <label for="review">Review:</label> <br>
                <textarea id="review" name="review" required></textarea><br>

                <button type="submit" class="submit_button">Submit Review</button>
            </form>
        </div>


        <!-- Showing Reviews -->
        <div class="review-section">
            <h3>Reviews</h3>
            <?php
            // Get reviews from database
            $sql = "SELECT * FROM reviews";
            $result = mysqli_query($conn, $sql);

            // If there are reviews,
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p><strong>User:</strong> " . $row['username'] . "</p>";
                    echo "<p><strong>Rating:</strong> " . $row['rating'] . "</p>";
                    echo "<p><strong>Review:</strong> " . $row['review_text'] . "</p>";
                    echo "<hr>";
                }
            } else {
                //If there is no review,
                echo "<p>No reviews yet.</p>";
            }

            // Connection Close
            mysqli_close($conn);
            ?>
        </div>


        <!--Showing Map-->
        <section class="map">
            <h2>Where You'll be</h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6714.492932817147!2d96.10507190102321!3d16.891843710589658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smm!4v1688996097917!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <p><b>Address:</b>Torino, Piemonte, Italy</p>
        </section>
    </main>

    <!--Showing Javascript-->
    <script>
        //Slide Show Javascript
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            const prevBtn = document.querySelector('#prev');
            const nextBtn = document.querySelector('#next');
            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach((slide) => {
                    slide.classList.remove('active');
                });

                slides[index].classList.add('active');
            }

            function goToPrevSlide() {
                currentSlide--;
                if (currentSlide < 0) {
                    currentSlide = slides.length - 1;
                }
                showSlide(currentSlide);
            }

            function goToNextSlide() {
                currentSlide++;
                if (currentSlide >= slides.length) {
                    currentSlide = 0;
                }
                showSlide(currentSlide);
            }

            prevBtn.addEventListener('click', goToPrevSlide);
            nextBtn.addEventListener('click', goToNextSlide);
            setInterval(goToNextSlide, 3000);
        });

        // Picking dates from calendar
        $(function() {
            $("#startDatePicker").datepicker({
                onSelect: function(selectedDate) {
                    $("#endDatePicker").datepicker("option", "minDate", selectedDate);
                }
            });
            $("#endDatePicker").datepicker({
                onSelect: function(selectedDate) {
                    $("#startDatePicker").datepicker("option", "maxDate", selectedDate);
                }
            });
        });

        // Rating (Star)
        $(document).ready(function() {
            $('.star-rating').change(function() {
                const rating = $(this).val();
                console.log(rating);
            });
        });
    </script>
</body>

</html>

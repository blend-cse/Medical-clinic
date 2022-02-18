<?php
if (session_id() == '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="vendors/font-awsome/css/all.css"/>
</head>

<body>

<div>
    <?php include "components/header.php" ?>

    <div id="Maincontent" style="position:relative;">
       <!--  <img src="photos/hero-img-1.jpg" alt=""/>-->

        <!-- Slideshow container -->
        <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="photos/slider11.jpg" style="width:100%">  
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="photos/hero-img-1.jpg" style="width:100%">
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="photos/slider2.jpg" style="width:100%">
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div style="text-align:center; width:100%; position:absolute; bottom:10px;">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>

        <div class="boxes-wrap">
            <div class="boxes">
                <div class="box">
                    <h4>Neurology</h4>
                    <p> Department of Neurology has a team
                        of highly trained specialists with vast experience.</p>
                    <a href="/medical-clinic/departments.php">Learn More</a>
                </div>
                <div class="box">
                    <h4>Cardiology</h4>
                    <p>Medical Clinic isone of the
                        the best Cardiology Hospitals in Hyderabad.</p>
                    <a href="/medical-clinic/departments.php">Learn More</a>
                </div>
                <div class="box">
                    <h4>Orthopedics</h4>
                    <p>Health is our greatest treasure and
                        with incredible specialists.</p>
                    <a href="/medical-clinic/departments.php">Learn More</a>
                </div>
            </div>
        </div>
       
       


    </div>
    <div class="Appointment">
        <p> Schedule your appointment online</p>

        <a href="/medical-clinic/contact.php" alt="About us" class="btnn btnlink">Book an Aoppointment</a>
    </div>
    <div class="Content">
        <p>Sign up for our newsletter</p>
        <form method="POST" action="newsletter.php">
            <input id="email" placeholder="Enter your email here" type="email" name="email" required>
            <button id="button" type="submit">Subscribe</button>
        </form>
    </div>
</div>
<footer>
    <div class="footer">
        <p>@UBT 2020.</p>
    </div>
</footer>
<script src="javascript/main.js"> </script>
</body>
</html>

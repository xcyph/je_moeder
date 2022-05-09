<?php

?>
<head>
    <title></title>
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/media.css">
</head>
<footer class="footer">
    <div class="footer__addr">

        <h2 class="nav__title">Contact</h2>

        <address>
            <ul class="nav__ul">
                <li>Adres:<a href="#"> 3090RD, Rotterdam</a></li>
                <li>Telefoon:<a href="#"> 06-2435647</a></li>
                <li>E-mail: <a href="mailto:example@gmail.com">example@gmail.com</a></li>
            </ul>
        </address>
    </div>

    <ul class="footer__nav">
        <li class="nav__item">
            <h2 class="nav__title">Pagina's</h2>

            <ul class="nav__ul">
                <?php
                // Controleert of er een gebruiker ingelogd is zo niet laad die een andere list in
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                    echo"<li><a href='index.php'>Home</a></li>";
                    echo "<li><a href='show.php'>Booking</a></li>";
                    echo "<li><a href='review.php'>Reviews</a></li>";
                    echo "<li><a href='info.php'>Info</a></li>";
                }else{
                    echo"<li><a href='index.php'>Home</a></li>";
                    echo "<li><a href='php/login/login.php'>Booking</a></li>";
                    echo "<li><a href='php/login/login.php'>Reviews</a></li>";
                    echo "<li><a href='info.php'>Info</a></li>";
                }
                ?>
            </ul>
        </li>

        <li class="nav__item">
            <h2 class="nav__title">Media</h2>

            <ul class="nav__ul">
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">TikTok</a></li>
            </ul>
        </li>

        <li class="nav__item">
            <h2 class="nav__title">Legal</h2>

            <ul class="nav__ul">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Sitemap</a></li>
            </ul>
        </li>
    </ul>

    <div class="legal">
        <p>&copy; 2022 Damian Hollaardt (84219)</p>
    </div>
</footer>

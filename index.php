<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>KIKS FLICK</title>
    <link rel="stylesheet" href="CSS/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="navbar__menu-item.js">
</head>
<header>
    <a href="index.php"><img id="logo" style="width:250px; height:100px;" src="images/logo1-2.png" alt="Logo"></a>
    <!--<a href="#" class="logo">Logo</a>-->
    <!--  <img src="logo2.png" class="logo" alt="">-->
    <ul class="nav">
        <li> <a href="index.php">HOME</a></li>
        <li> <a href="shop.html">SHOP</a></li>
        <li><a href="FAQ.html">FAQ</a></li>
        <li><a href="about.html">ABOUT</a></li>
        <li><a href="contact.html">CONTACT US</a></li>
        <a href="indexx.php"><i class="fa-solid fa-user" class="person"></i></a>
    </ul>
</header>
<!---->


<script type="text/javascript">
const menuItem = document.querySelector(".navbar__menu-item");

function followImageCursor(event, menuItem) {
    const contentBox = menuItem.getBoundingClientRect();
    const dx = event.pageX - contentBox.x;
    const dy = event.pageY - contentBox.y;
    menuItem.children[1].style.transform = `translate(${dx}px, ${dy}px)`;
}

menuItem.addEventListener("mousemove", (event) => {
    setInterval(followImageCursor(event, menuItem), 1000);
});
</script>



<script type="text/javascript">
window.addEventListener("scroll", function() {
    var header = document.querySelector("header");
    var logo = document.getElementById("logo");

    header.classList.toggle("sticky", window.scrollY > 0);
    logo.classList.toggle("sticky-logo", window.scrollY > 0);

    // Change the logo source and size when scrolled
    if (window.scrollY > 0) {
        logo.src = "images/logo3-2.png"; // Change to the path of the new logo image
        logo.style.width = "250px"; // Set the width to your desired value
        logo.style.height = "100px"; // Set the height to your desired value
    } else {
        logo.src = "images/logo1-2.png"; // Change to the path of the original logo image
        logo.style.width = "250px"; // Set the width to your desired value
        logo.style.height = "100px"; // Set the height to your desired value
    }
});
</script>



<body>

    <div class="banner">
        <img src="images/skate.jpg" alt="">
    </div>

    <div class="first_txt">
        <h1>OUR LATEST COLLECTION</h1>
    </div>

    <div class="products">
        <figure class="snip0068 blue"><img src="images/BBRCM.jpg" alt="sampl31" />
            <figcaption>
                <div>
                    <h3 style="font-size:17px;">Beach Bliss Radiance Collection</h3>
                </div>
                <div><span>View Products</span></div>
                <a href="shop.html"></a>
            </figcaption>
        </figure>
        <figure class="snip0068 red"><img src="images/MOCM.jpg" alt="sample48" />
            <figcaption>
                <div>
                    <h3>
                        Midnight Odyssey Collection</h3>
                </div>
                <div><span>View Products</span></div>
                <a href="shop.html"></a>
            </figcaption>
        </figure>

    </div>

    <script>
    /* Demo purposes only */
    $("figure").mouseleave(
        function() {
            $(this).removeClass("hover");
        }
    );
    </script>

    <div class="footer">
        <img src="images/logo.png" alt="">
        <p>Elevate Your Style, Illuminate Your Life.</p>
        <div class="footer_nav">
            <a href="about.html">About Us</a>
            <a href="FAQ.html">FAQS</a>
            <a href="contact.html">Contact Us</a>
        </div>

        <div class="footer-more">
            <div class="footer1">
                <h1>Subscribe to our newsletter:</h1>
                <form>
                    <input type="text" id="fname" name="fname" placeholder=" Your Email..">
                </form>
            </div>
            <div class="footer2">
                <h1>Follow and tag us on :</h1>
                <ul>
                    <li>
                        <a href="https://www.facebook.com">
                            <i class="fab fa-facebook-f icon"></i> </a>
                    </li>
                    <li>
                        <a href="https://www.twitter.com"><i class="fab fa-twitter icon"></i></a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com"><i class="fab fa-linkedin-in icon"></i></a>
                    </li>
                    <li>
                        <a href="https://support.google.com"><i class="fab fa-google-plus-g icon"></i></a>
                    </li>
                </ul>

            </div>
        </div>



    </div>





</body>


</html>
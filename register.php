<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/style.css">

</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Helvetica, Sans-Serif;
    font-weight: 900;
}

body {
    background: #fff;
    color: black;
}

header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: 0.6s;
    padding: 10px 100px;
    z-index: 10000;
    background-color: #000;
}

header #logo {
    height: 100px;
    width: 100px;
}

.person {
    color: #fff;
}

header ul {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

header ul li {
    position: relative;
    list-style: none;
}

header ul li a,
header ul a i .person {
    position: relative;
    margin: 0 10px;
    text-decoration: none;
    color: #fff;
    letter-spacing: 2px;
    font-weight: 500px;
    transition: 0.6;
}

header.sticky {
    padding: 1px 100px;
    background: #fff;
}

header.sticky .logo,
header.sticky ul li a,
header.sticky a {
    color: #000;
}

.nav {
    text-transform: uppercase;
    text-align: center;
    font-weight: 600;
}

.nav * {
    box-sizing: border-box;
    transition: all .35s ease;
}

.nav li {
    display: inline-block;
    list-style: outside none none;
    margin: .5em 1em;
    padding: 0;
}

.nav a {
    padding: .5em .8em;
    position: relative;
    text-decoration: none;
    font-size: 20px;
    color: #fff;
}

.nav a::before,
.nav a::after {
    content: '';
    height: 14px;
    width: 14px;
    position: absolute;
    transition: all .35s ease;
    opacity: 0;
}

.nav a::before {
    content: '';
    right: 0;
    top: 0;
    border-top: 3px solid #3E8914;
    border-right: 3px solid #2E640F;
    transform: translate(-100%, 50%);
}

.nav a:after {
    content: '';
    left: 0;
    bottom: 0;
    border-bottom: 3px solid #2E640F;
    border-left: 3px solid #3E8914;
    transform: translate(100%, -50%)
}

.nav a:hover:before,
.nav a:hover:after {
    transform: translate(0, 0);
    opacity: 1;
}

.nav a:hover {
    color: #3DA35D;
}
</style>
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

    <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

    <div class="form-container">

        <form action="" method="post">
            <h3>register now</h3>
            <input type="text" name="name" required placeholder="enter username" class="box">
            <input type="email" name="email" required placeholder="enter email" class="box">
            <input type="password" name="password" required placeholder="enter password" class="box">
            <input type="password" name="cpassword" required placeholder="confirm password" class="box">
            <input type="submit" name="submit" class="btn" value="register now">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>

    </div>

</body>

</html>
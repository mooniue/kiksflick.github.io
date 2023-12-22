<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:indexx.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:indexx.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/style.css">

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




    <div class="container">
        <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div style="margin-top:8%;" class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
        <div class="user-profile">

            <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
            ?>


            <p> username : <span><?php echo $fetch_user['name']; ?></span> </p>
            <p> email : <span><?php echo $fetch_user['email']; ?></span> </p>
            <div class="flex">
                <a href="login.php" class="btn">login</a>
                <a href="register.php" class="option-btn">register</a>
                <a href="indexx.php?logout=<?php echo $user_id; ?>"
                    onclick="return confirm('are your sure you want to logout?');" class="delete-btn">logout</a>
            </div>

        </div>

        <div class="products">

            <h1 class="heading">latest products</h1>

            <div class="box-container">

                <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
        ?>
                <form method="post" class="box" action="">
                    <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
                    <div class="name"><?php echo $fetch_product['name']; ?></div>
                    <div class="price">₱ <?php echo $fetch_product['price']; ?>.00</div>
                    <input type="number" min="1" name="product_quantity" value="1">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                </form>

                <?php
      };
   };
   ?>

            </div>

        </div>

        <div class="shopping-cart">

            <h1 class="heading">shopping cart</h1>

            <table>
                <thead>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>total price</th>
                    <th>action</th>
                </thead>
                <tbody>
                    <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
                    <tr>
                        <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_cart['name']; ?></td>
                        <td>₱<?php echo $fetch_cart['price']; ?>/-</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                <input type="number" min="1" name="cart_quantity"
                                    value="<?php echo $fetch_cart['quantity']; ?>">
                                <input type="submit" name="update_cart" value="update" class="option-btn">
                            </form>
                        </td>
                        <td>₱<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
                        <td><a href="indexx.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn"
                                onclick="return confirm('remove item from cart?');">remove</a></td>
                    </tr>
                    <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
                    <tr class="table-bottom">
                        <td colspan="4">grand total :</td>
                        <td>₱<?php echo $grand_total; ?>/-</td>
                        <td><a href="indexx.php?delete_all" onclick="return confirm('delete all from cart?');"
                                class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
                    </tr>
                </tbody>
            </table>

            <div class="cart-btn">
                <a href="#" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
            </div>

        </div>

    </div>

</body>

</html>
<?php
    $pagetitle="";  
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pagetitle !== "" ? $pagetitle : "Sendiri Bake"; ?></title>
    <link rel="stylesheet" type="text/css" href="stylecust.css">
    <link rel="stylesheet" type="text/css" href="custstyle.css">
</head>
<body>
    <div class="navbar">
        <div class="brand">
            <h1>Sendiri Bake</h1>
        </div>
        <nav class="nav-links">
            <a href="Catalogue.php">Catalogue</a>
            <a href="About.php">Order History</a>
            <a href="About.php">About</a>
            <a href="CustContactUs.php">Contact Us</a>
            <!-- Add more links as needed -->
        </nav>
    </div>

    <section> <!--copy here untuk other pages -->
        <div class="main" style="padding-top: 30px;"> 
        <a href="YourCart.php" class="cart-button">Your Cart</a>

            <!-- The rest of your page content -->
        </div>
    </section>
</body>
</html>

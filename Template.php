<?php
    $pagetitle="";  
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pagetitle !== "" ? $pagetitle : "Sendiri Bake"; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!--sidebar dont change-->
    <section> 
        <div class="sidebar">
            <h1>Sendiri Bake</h1>
            <a href="Home.php">Home</a>
            <a href="ManageCat.php">Manage Catalogue</a>
            <a href="ManageQuota.php">Manage Order Quota</a>
            <a href="NewOrders.php">New Orders</a>
            <a href="ActiveOrders.php">Active Orders</a>
            <a href="#">Reports</a>
        </div>
    </section>

    <section> <!--copy here untuk other pages -->
        <div class="main" style="padding-top: 50px;"> 
            

        </div>
    </section>




</body>
</html>
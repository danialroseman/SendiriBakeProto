<?php
$pagetitle = "Manage Catalogue";  
include("Template.php");
include("db_connection.php");
$query = "SELECT * FROM products";
$result = mysqli_query($connection, $query);
?>

<section>
    
    <div class="main"> 
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 style="font-size: 35px; font-weight:bold;">Products List</h1>
            <a href="addproduct.php"><button>Add New Product</button></a>
        </div>
        <div id="productImages">
            
            <?php
            // Loop through the fetched products and create image elements with corresponding name and price
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='productItem'>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['Pimage']) . "' alt='{$row['Pname']}' onclick='redirectToEdit({$row['Id']})'>";
                echo "<p>{$row['Pname']}</p>";
                echo "<p>Price: {$row['price']}</p>";
                echo "</div>";
            }
            ?>
        </div>
        
    </div>
</section>

<script>
    // Function to replace placeholder with actual images and details
    function loadProducts() {
        setTimeout(function() {
            var productImages = document.createElement("div");

            <?php
            mysqli_data_seek($result, 0); // Reset pointer to start of the result set
            while ($row = mysqli_fetch_assoc($result)) {
                echo "productImages.innerHTML += `<div class='productItem'><img src='data:image/jpeg;base64," . base64_encode($row['Pimage']) . "' alt='{$row['Pname']}' onclick='redirectToEdit({$row['Id']})'><p>{$row['Pname']}</p><p>Price: {$row['price']}</p></div>`;";
            }
            ?>

            document.getElementById("productImages").innerHTML = productImages.innerHTML;
        }, 2000); // 2000 milliseconds (2 seconds) delay
    }

    // Call loadProducts function when the page loads
    window.onload = loadProducts;

    // Function to redirect to editproduct.php with product ID as parameter
    function redirectToEdit(productId) {
        window.location.href = `editproduct.php?productId=${productId}`;
    }
</script>

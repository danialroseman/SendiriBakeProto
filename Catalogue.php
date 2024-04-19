<?php
    $pagetitle = "Catalogue";
    include("CustTemplate.php");
    include("db_connection.php");

    // Fetch products from the database
    $query = "SELECT * FROM products";
    $result = mysqli_query($connection, $query);
?>

<section> 
    <div class="main" > 
        <h1 style="font-size: 30px; color:#545F71; font-weight:bold; padding-left:50px;">Products List</h1>
        <div id="productImages">
            <?php
            // Check if there are products available
            if (mysqli_num_rows($result) > 0) {
                // Loop through each product and display its details
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product'>";
                    // Wrap the image in an anchor tag to make it clickable
                    echo "<a href='custproductpage.php?productId={$row['Id']}'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['Pimage']) . "' alt='{$row['Pname']}'><br>";
                    echo "</a>";
                    echo "<h2>{$row['Pname']}</h2>";
                    echo "<p>Price: {$row['price']}</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No products available</p>";
            }
            ?>
        </div>
    </div>
</section>


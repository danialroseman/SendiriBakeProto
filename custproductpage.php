<?php
    $pagetitle = "Product Details";
    include("CustTemplate.php");
    include("db_connection.php");

    $product = null;

    // Check if productId is set in the URL
    if (isset($_GET['productId'])) {
        $productId = $_GET['productId'];

        // Fetch the product details using the productId
        $query = "SELECT * FROM products WHERE Id = $productId";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
        }
    }
?>

<section> 
    <div class="main"> 
        <a href="Catalogue.php" class="back-button">< Back To Catalogue</a>
        <?php if ($product): ?>
            <div class="product-container">
                <div class="editproduct-image">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($product['Pimage']); ?>" alt="<?php echo $product['Pname']; ?>"><br><br>
                </div>
                <div class="editproduct-details">
                    <h2 style="font-size:40px;"><?php echo $product['Pname']; ?></h2>
                    <p><?php echo $product['price']; ?></p>
                    <p><?php echo $product['Pdesc']; ?></p>
                    <form method="post" action="cart.php"> <!-- Change 'cart.php' to your cart handling page -->
                        <input type="hidden" name="productId" value="<?php echo $product['Id']; ?>">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"><br><br>
                        <input type="submit" name="addToCart" value="Add to Cart">
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p>No product found</p>
        <?php endif; ?>
    </div>
</section>


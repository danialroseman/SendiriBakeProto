<?php
    $pagetitle = "Edit Product";  
    include("Template.php");
    include("db_connection.php");

    // Check if productId is set in the URL
    if (isset($_GET['productId'])) {
        $productId = $_GET['productId'];

        // Fetch the product details using the productId
        $query = "SELECT * FROM products WHERE Id = $productId";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            // Retrieve product details
            $productName = $product['Pname'];
            $productPrice = $product['price'];
            $productDescription = $product['Pdesc'];
            // Assume image is stored in database as BLOB
            $productImage = $product['Pimage'];

            // Check if form submitted for updating product details
            if (isset($_POST['updateProduct'])) {
                // Retrieve updated values from form submission
                $updatedProductName = $_POST['productName'];
                $updatedProductPrice = $_POST['productPrice'];
                $updatedProductDescription = $_POST['productDescription'];
        
                // Check if a new image is being uploaded
                if ($_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
                    // Retrieve temporary location of the uploaded file
                    $tmp_name = $_FILES['productImage']['tmp_name'];
        
                    // Read the contents of the uploaded file
                    $newProductImage = file_get_contents($tmp_name);
        
                    // Escape special characters to avoid SQL injection
                    $newProductImage = mysqli_real_escape_string($connection, $newProductImage);
        
                    // Update the database with the new image and other values
                    $updateQuery = "UPDATE products SET Pname='$updatedProductName', price='$updatedProductPrice', Pdesc='$updatedProductDescription', Pimage='$newProductImage' WHERE Id=$productId";
                } else {
                    // Update the database without changing the image
                    $updateQuery = "UPDATE products SET Pname='$updatedProductName', price='$updatedProductPrice', Pdesc='$updatedProductDescription' WHERE Id=$productId";
                }
        
                // Execute the update query
                $updateResult = mysqli_query($connection, $updateQuery);
        
                if ($updateResult) {
                    // Redirect to the same page after update (refresh the data)
                    header("Location: ManageCat.php?productId=$productId");
                    exit();
                } else {
                    echo "Update failed: " . mysqli_error($connection);
                }
            }//end 
            // Delete the product from the database
            if (isset($_POST['deleteProduct'])) {
                $deleteQuery = "DELETE FROM products WHERE Id = $productId";
                $deleteResult = mysqli_query($connection, $deleteQuery);
    
                if ($deleteResult) {
                    // Redirect to a different page after deletion or perform any other action
                    header("Location: ManageCat.php"); // Redirect to a page showing the list of products
                    exit();
                } else {
                    echo "Deletion failed: " . mysqli_error($connection);
                }
            }//end
        }
    }
?>

<section> 
    <div class="main" style="padding-top: 50px;"> 
        <h1 style="font-size: 35px; font-weight:bold;">Edit Product Details</h1>
        <!-- Display product details -->
        <?php if (isset($product)): ?>
            <form method="post" enctype="multipart/form-data">
                <div class="product-container">
                    <div class="editproduct-image">
                        <!-- Display the current image -->
                        <img id="currentImage" src="data:image/jpeg;base64,<?php echo base64_encode($productImage); ?>" alt="<?php echo $productName; ?>"><br><br>
                        <!-- Allow the user to change the image -->
                        <input type="file" id="uploadImage" name="productImage" accept="image/*">
                    </div>
                    <div class="editproduct-details">
                        <h2><input type="text" name="productName" value="<?php echo $productName; ?>" class="productname"><br><br></h2>
                        <input type="text" name="productPrice"  value="<?php echo $productPrice; ?>" class="productprice"><br><br>
                        <textarea name="productDescription" class="productdesc" rows="4" cols="50"><?php echo $productDescription; ?></textarea><br><br>
                        <input type="submit" name="updateProduct" value="Update">
                        <input type="submit" name="deleteProduct" value="Delete" onclick="return confirm('Are you sure you want to delete this product?');">
                    </div>
                </div>
            </form>
        <?php else: ?>
            <p>No product found.</p>
        <?php endif; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            alert('Product has been updated');
        });

        // Handle image preview
        const uploadImage = document.getElementById('uploadImage');
        const currentImage = document.getElementById('currentImage');

        uploadImage.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>


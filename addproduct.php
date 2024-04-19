<?php
    $pagetitle = "Add Product";  
    include("Template.php");
    include("db_connection.php");

    // Check if form submitted for adding a new product
    if (isset($_POST['addProduct'])) {
        // Retrieve values from the form submission
        $newProductName = $_POST['productName'];
        $newProductPrice = $_POST['productPrice'];
        $newProductDescription = $_POST['productDescription'];
        
        // Process the uploaded image
        $newProductImage = ''; // Placeholder for storing image data
        if ($_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
            // Retrieve temporary location of the uploaded file
            $tmp_name = $_FILES['productImage']['tmp_name'];

            // Read the contents of the uploaded file
            $newProductImage = file_get_contents($tmp_name);

            // Escape special characters to avoid SQL injection
            $newProductImage = mysqli_real_escape_string($connection, $newProductImage);
        }

        // Insert the new product details into the database including the image
        $insertQuery = "INSERT INTO products (Pname, price, Pdesc, Pimage) VALUES ('$newProductName', '$newProductPrice', '$newProductDescription', '$newProductImage')";
        $insertResult = mysqli_query($connection, $insertQuery);

        if ($insertResult) {
            // Redirect to the managecat.php page after adding the product
            header("Location: managecat.php");
            exit();
        } else {
            echo "Addition failed: " . mysqli_error($connection);
        }
    }
?>

<section> 
    <div class="main" style="padding-top: 50px;"> 
        <h1 style="font-size: 35px; font-weight:bold;">Add New Product</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="product-container">
                <div class="editproduct-image">
                    <!-- Image placeholder for the new product -->
                    <img id="previewImage" src="path_to_default_image.jpg" alt="New Product Image"><br><br>
                    <input type="file" name="productImage" id="uploadImage" accept="image/*">
                </div>
                <div class="editproduct-details">
                    <!-- Move the file upload input below the image -->
                    <input type="text" name="productName" placeholder="Product Name" class="productname"><br><br>
                    <input type="text" name="productPrice" placeholder="Product Price" class="productprice"><br><br>
                    <textarea name="productDescription" placeholder="Product Description" class="productdesc" rows="4" cols="50"></textarea><br><br>
                    <input type="submit" name="addProduct" value="Add Product">
                </div>
            </div>
        </form>     
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadImage = document.getElementById('uploadImage');
        const previewImage = document.getElementById('previewImage');

        uploadImage.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>

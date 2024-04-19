<?php
    $pagetitle = "New Orders";  
    include("Template.php");
    include("db_connection.php");

    // Update Order Status if 'accept' or 'reject' button is clicked
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['orderId'])) {
        $orderId = $_POST['orderId'];
        if (isset($_POST['accept'])) {
            // Update order status to 'accept' in the database
            $updateQuery = "UPDATE placeorder SET status = 'accept' WHERE Id = $orderId";
        } elseif (isset($_POST['reject'])) {
            // Update order status to 'reject' in the database
            $updateQuery = "UPDATE placeorder SET status = 'reject' WHERE Id = $orderId";
        }
        
        if (mysqli_query($connection, $updateQuery)) {
            // Status updated successfully
            // Redirect back to New Orders after update
            header("Location: NewOrders.php");
            exit();
        } else {
            // Handle update failure
            echo "Error updating order status: " . mysqli_error($connection);
        }
    }

    // Fetch new orders with 'pending' status from the database
    $query = "SELECT * FROM placeorder WHERE status = 'pending'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $fetchedOrders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        // Handle query failure
        $fetchedOrders = [];
    }
?>

<section> 
    <div class="main" style="padding-top: 50px;"> 
        <h1 style="font-size: 35px; font-weight:bold;">New Orders</h1>

        <?php if (!empty($fetchedOrders)) : ?>
            <table class="orders-table">
                <tr>
                    <th>Order ID</th>
                    <th>Order Details</th>
                    <th>Total Price</th>
                    <th>Pickup Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($fetchedOrders as $order) : ?>
                    <tr>
                        <td><?= $order['Id'] ?></td>
                        <td><?= $order['orderdetails'] ?></td>
                        <td><?= $order['totalprice'] ?></td>
                        <td><?= $order['pickup'] ?></td>
                        <td><?= $order['status'] ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="orderId" value="<?= $order['Id'] ?>">
                                <!-- Displaying accept and reject buttons -->
                                <input type="submit" name="accept" value="Accept">
                                <input type="submit" name="reject" value="Reject">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>No new orders found.</p>
        <?php endif; ?>
    </div>
</section>

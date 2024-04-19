<?php
    $pagetitle = "Active Orders";  
    include("Template.php");
    include("db_connection.php");

    // Fetch accepted orders from the database
    $query = "SELECT * FROM placeorder WHERE status = 'accept'"; // Assuming 'accept' is the status for accepted orders
    $result = mysqli_query($connection, $query); // Execute the query

    if ($result) {
        $acceptedOrders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        // Handle query failure
        $acceptedOrders = [];
    }
?>

<section>
    <div class="main" style="padding-top: 50px;">
        <h1 style="font-size: 35px; font-weight:bold;">Active Orders</h1>

        <?php if (!empty($acceptedOrders)) : ?>
            <!-- Display accepted orders in a table -->
            <table class="orders-table">
                <tr>
                    <th>Order ID</th>
                    <th>Order Details</th>
                    <th>Total Price</th>
                    <th>Pickup Date</th>
                    <th>Status</th>
                </tr>

                <!-- Loop through fetched accepted orders and display in rows -->
                <?php foreach ($acceptedOrders as $order) : ?>
                    <tr>
                        <td><?= $order['Id'] ?></td>
                        <td><?= $order['orderdetails'] ?></td>
                        <td><?= $order['totalprice'] ?></td>
                        <td><?= $order['pickup'] ?></td>
                        <td><?= $order['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>No active orders found.</p>
        <?php endif; ?>
    </div>
</section>

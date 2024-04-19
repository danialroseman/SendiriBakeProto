<?php
    $pagetitle = "Edit Quota";  
    include("Template.php");
    include("db_connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form fields are set and not empty
        if (isset($_POST['start'], $_POST['end'], $_POST['quota'], $_POST['basic'], $_POST['custom'])) {
            // Retrieve and sanitize form data
            $start = mysqli_real_escape_string($connection, $_POST['start']);
            $end = mysqli_real_escape_string($connection, $_POST['end']);
            $quota = mysqli_real_escape_string($connection, $_POST['quota']);
            $basic = mysqli_real_escape_string($connection, $_POST['basic']);
            $custom = mysqli_real_escape_string($connection, $_POST['custom']);

            // Perform database update
            $updateQuery = "UPDATE quota SET WeekStart='$start', WeekEnd='$end', quota='$quota', filled='$basic' "; // Modify 'some_condition' based on your requirements
            mysqli_query($connection, $updateQuery);

            // Redirect back to managequota.php after update
            header("Location: managequota.php");
            exit();
        }
    }
?>

<section> 
    <div class="main" style="padding-top: 50px; align-items: center;"> 
        <h1 style="font-size: 35px; font-weight:bold;">Manage Order Quota</h1>
        <form class="editquota" method="POST" action="editquota.php">
            <div class="date-input">
                <label for="start">Start Date:</label>
                <input type="date" id="start" name="start">
                <label for="end">End Date:</label>
                <input type="date" id="end" name="end">
            </div>
            <label for="quota">Order Quota</label>
            <input type="text" id="quota" name="quota">
            <label for="basic">Basic Orders</label>
            <input type="text" id="basic" name="basic">
            <label for="custom">Custom Orders</label>
            <input type="text" id="custom" name="custom">
            <button type="submit">Save</button>
        </form>
    </div>
</section>

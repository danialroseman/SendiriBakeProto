<?php
    $pagetitle = "Manage Quota";  
    include("Template.php");
    include("db_connection.php");

    // Retrieve quota information including the new 'custom' field
    $query = "SELECT Id, WeekStart, WeekEnd, quota, filled, custom FROM quota"; // Add 'custom' field to the query
    $result = mysqli_query($connection, $query);

    $labels = [];
    $availableQuotas = [];
    $filledQuotas = [];
    $customQuotas = []; // Add an array to store custom quotas

    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = "{$row['WeekStart']} - {$row['WeekEnd']}";
        $availableQuotas[] = $row['quota'] - $row['filled'];
        $filledQuotas[] = $row['filled'];
        $customQuotas[] = $row['custom']; // Store custom quota values
    }
?>

<section> 
    <div class="main" style="padding-top: 50px; align-items: center;"> 
        <h1 style="font-size: 35px; font-weight:bold;">Order Quota</h1>
        <div>
            <canvas id="quotaChart" width="400" height="400"></canvas>
        </div>
        <div class="edit-button-container">
            <a href="editquota.php" class="edit-button">Edit Quota</a>
        </div>
    </div>
</section>

<!-- Include the chart script at the end of your managequota.php file -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('quotaChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [
                {
                    label: ['Available Quota', 'Filled Quota', 'Custom Quota'], // Add 'Custom Quota' label
                    data: [
                        <?php 
                            foreach($availableQuotas as $index => $available) {
                                $filled = $filledQuotas[$index];
                                $custom = $customQuotas[$index]; // Fetch custom quota value
                                echo "$available, $filled, $custom,"; // Include the custom quota value
                            }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)', // Available quota color
                        'rgba(255, 99, 132, 0.7)', // Filled quota color
                        'rgba(75, 192, 192, 0.7)' // Custom quota color (you can add more colors if needed)
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

<?php include('components/navbar.php'); ?>
<?php include('components/sidebar.php'); ?>

<div class="content">
    <div class="container-fluid">
        <!-- Row 1: Stats -->
        <?php include('components/card-statistics.php'); ?>

        <!-- Row 2: Product Table -->
        <div class="row">
            <?php include('components/product-table.php'); ?>
        </div>

        <!-- Row 3: Chart -->
        <div class="row mt-4">
            <?php include('components/chart.php'); ?>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Doanh thu',
                data: [100000, 150000, 180000, 120000, 250000],
                borderColor: 'rgba(0, 123, 255, 1)',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
</body>

</html>
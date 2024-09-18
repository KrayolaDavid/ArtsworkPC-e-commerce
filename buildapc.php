<?php
ob_start();

include('function/userfunction.php');
include('includes/header.php'); 
include('authenticate.php');
include('config/dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build a PC</title>
    <link rel="stylesheet" href="asset/css/buildapc.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="py-3 bg-info">
        <div class="container">
            <h6 class="text-white">
                <a style="text-decoration:none" class="text-white" href="index.php">Home /</a>
                <a style="text-decoration:none" class="text-white" href="buildapc.php">Build A PC</a>
            </h6>
        </div>
    </div>

    <main>
        <div class="buildapc">
            <div class="chart">
                <div class="content">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="selected">
                <h1 class="text-3xl font-bold mb-4 text-center">Selected Items</h1>
                <div class="selected-parts">
                    <?php
                        $items = getSelectedItems();
                        if ($items && mysqli_num_rows($items) > 0) {  // Check if query succeeded and returned rows
                    ?>
                        <div id="items-container">
                            <?php
                            foreach($items as $citem) {
                            ?>
                            <div class="selected-items">
                                <img src="upproduct/<?= $citem['image'] ?>" alt="Component Image"
                                class="parts-selected-img">
                                <div class="item-content"
                                    value="<?= $citem['category_id'] ?>,<?= $citem['rating'] ?>">
                                    <h4 class="item-name"><?= $citem['name'] ?></h4>
                                </div>
                                <div class="btn-div">
                                   <button name="clear-itm-cpu-btn" class="btn-clear" value="<?= $citem['cid'] ?>">Clear</button>
                                   <button name="compare-item-btn" class="btn-compare">Compare</button>
                                   <button name="btn-addtocart" class="btn">Add to cart</button>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                        } else {
                            if (!$items) {  // Query failed
                                echo "Error fetching selected items: " . mysqli_error($con);
                            } else {  // No rows returned
                                echo "<h4 class=\"item-name\">No Selected Items</h4>";
                            }
                        }
                    ?>
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
                integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="asset/js/radarchart.js"></script>
        </div>
        
        <div class="parts-select">
            <h1 class="text-3xl font-bold mb-4 text-center">Select PC Parts</h1>
            <div class="selection">
                <?php 
                
                $components = getAllActive("components");

                if ($components && mysqli_num_rows($components) > 0) {  // Check if query succeeded and returned rows
                    foreach($components as $item) {
                ?>
                <a style="text-decoration:none" href="product.php?component=<?= $item['slug']?>">
                    <div class="part-items">
                        <img src="uploads/<?= $item['image']?>" alt="Component Image" class="parts-select-img">
                        <h4 class="text-center"><?= $item['name']?></h4>
                    </div>
                </a>
                <?php  
                    }
                } else {
                    if (!$components) {  // Query failed
                        echo "Error fetching components: " . mysqli_error($con);
                    } else {  // No rows returned
                        echo "No available data";
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <script>
        function refreshPage() {
            location.reload();
        }

        document.getElementById('refreshButton').onclick = refreshPage;

        const categoryMap = {
            28: '$computing',
            29: '$rendering',
            30: 'motherboard',
            31: '$datatransferspeed',
            32: 'cooler',
            33: '$datastorage',
            34: '$datastorage',
            36: '$datastorage',
            37: '$powercapacity',
            38: 'case',
            39: 'mouse',
            40: 'keyboard'
        };

        function getComponentByCategoryId(categoryId) {
           return categoryMap[categoryId] || 'Unknown category';
        }

        const ctx = document.getElementById('myChart').getContext('2d');

        const data = {
            labels: [
                'Computing',
                'Rendering',
                'Data Transfer Speed',
                'Power Capacity',
                'Data Storage'
            ],
            datasets: [{
                labels: 'My First Dataset',
                data: <?php echo json_decode() ?>,
                fill: true,
                backgroundColor: 'rgb(242, 244, 245)',
                borderColor: 'rgb(255, 255, 255)',
                pointBackgroundColor: 'rgb(255, 255, 255)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(255, 255, 255)',
            }]
        };

        const config = {
            type: 'radar',
            data,
            options:{
                scales: {
                    r: {
                        beingAtZero: true,
                        min: 0,
                        max: 10,
                        ticks: {
                            stepSize: 1,
                            callback: (value, tick, values) => {
                                console.log(value)
                            }
                        },
                        grid: {
                            color: 'black'
                        }
                    }
                },
                elements: {
                    line: {
                        borderWidth: 20
                    }
                }
            }
        }

        const myChart = new Chart(ctx, config);
    </script>
</body>

</html>

<?php ob_end_flush(); ?>
<?php include('includes/footer.php'); ?>
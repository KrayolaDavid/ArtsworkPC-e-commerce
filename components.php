<?php
include('function/userfunction.php');
include('includes/header.php'); 
 ?>

<div class="py-3 bg-info">
    <div class="container">
    
                
            </a>
        <h6 class="text-white">
        <a style="text-decoration:none" class="text-white" href="index.php">Home / <a style="text-decoration:none" class="text-white">Components</a></h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Computer Components</h1>
                <hr>
                <div class="row">
                
                <?php 
                
                    $components = getAllActive("components");

                    if(mysqli_num_rows($components) > 0)
                    {
                        foreach($components as $item)
                        {
                           ?>
                                <div class="col-md-3 mb-2">
                                    <a style="text-decoration:none" href="product.php?component=<?= $item['slug']?>">
                                        <div class="card shadow ">
                                            <div class="card-body " >
                                                <img src="uploads/<?= $item['image']?>" alt="Component Image" class="w-100">
                                                <h4 class="text-center"><?= $item['name']?></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                           <?php  
                        }
                    }
                    else
                    {
                        echo"No data";
                    }
                
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

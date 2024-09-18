<?php
include('function/userfunction.php');
include('includes/header.php'); 

if(isset($_GET['component']))
{

$category_slug = $_GET['component'];
$category_data = getSlugActive("components",$category_slug);
$category = mysqli_fetch_array($category_data);

if($category)
{

$cid = $category['id'];

?>



<div class="py-3 bg-info">
    <div class="container">
        <h6 class="text-white">
            <a style="text-decoration:none" class="text-white" href="components.php">
                Home /
            </a>
            <a style="text-decoration:none" class="text-white" href="components.php">
                Components /
            </a>
            <?= $category['name']?> </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $category['name']?></h1>
                <hr>
                <div class="row">

                    <?php 
                
                    $products = getProdByComponent($cid);

                    if(mysqli_num_rows($products) > 0)
                    {
                        foreach($products as $item)
                        {
                           ?>
                    <div class="col-md-3 mb-2">
                        <a href="product-view.php?product=<?= $item['slug']?>">
                            <div class="card shadow ">
                                <div class="card-body ">
                                    <img src="upproduct/<?= $item['image']?>" alt="Product Image" class="w-100">
                                    <h4 class="text-center text-decoration:none"><?= strlen($item['name']) > 15 ? substr($item['name'],0,15).'...' : $item['name']?></h4>
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

<?php 
}
else
{
    echo "Something went wrong";
}
}
else
{
    echo "Something went wrong";
}
include('includes/footer.php');
?>

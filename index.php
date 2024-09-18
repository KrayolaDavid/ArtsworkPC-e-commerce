<?php


include('function/userfunction.php'); 
include('includes/header.php'); 
include('includes/slider.php'); 
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Trending Products</h4>
                <div class="underlines mb-2"></div>
                <hr>
                <div class="owl-carousel">
                    <?php
                        $trendingProducts = getAllTrending();
                        if(mysqli_num_rows($trendingProducts) > 0)
                        {
                            foreach($trendingProducts as $item)
                        {
                            $productName = $item['name'];
                            if(strlen($productName) > 20) {
                            $productName = substr($productName, 0, 20). '...';
                            }
                                ?>
                    <div class="item">
                        <a href="product-view.php?product=<?= $item['slug']?>">
                            <div class="card shadow ">
                                <div class="card-body ">
                                    <img src="upproduct/<?= $item['image']?>" alt="Product Image" class="w-100">
                                    <h6 class="text-center text-decoration:none"
                                        style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?= $productName?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <h4>Budget Friendly</h4>
                    <div class="underlines mb-2"></div>
                    <hr>
                    <button type="button" class="btn btn-success">Success</button>
                    <button type="button" class="btn btn-success">Success</button>
                    <button type="button" class="btn btn-success">Success</button>
            </div>
        </div>
    </div>                   
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Our Products</h4>
                <div class="underlined mb-2"></div>
                <hr>
                <div class="row">
                    <?php
                        $allProducts = getAllProducts();
                        if(mysqli_num_rows($allProducts) > 0)
                        {
                            foreach($allProducts as $item)
                            {
                                $productName = $item['name'];
                                if(strlen($productName) > 15) {
                                    $productName = substr($productName, 0, 15) . '...';
                                }
                            ?>
                                <div class="col-md-3 mb-2">
                                    <a href="product-view.php?product=<?= $item['slug'] ?>">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <img src="upproduct/<?= $item['image'] ?>" alt="Product Image" class="w-100">
                                                <h4 class="text-center text-decoration-none"><?= $productName ?></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                            }
                        }
                        else
                        {
                            echo "<h5>No products available</h5>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>About us</h4>
                <div class="underline mb-2"></div>
                <p>
                    I Powered by Artzwork PC
                </p>
            </div>

        </div>
    </div>
</div>
</div>
<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h4 class="text-white">Artzwork PC</h4>
                <div class="underliner mb-2"></div>
                <a href="index.php" class="text-white"><i class="fa fa-angle-right"></i>HOME</a>
            </div>
            <div class="col-md-2">
                <h4 class="text-white"><i class="fa fa-home"></i> Address</h4>
                <p class="text-white">Phase 4 Package 4 Bagong Silang Caloocan City.</p>
                <a href="https://goo.gl/maps/yQRSY5fvp4gXxkHQA"  target="_blank" >https://goo.gl/maps/yQRSY5fvp4gXxkHQA</a>
                <h4 class="text-white"><i class="fa fa-phone"></i> Contact</h4>
                <a href="#"> 09279489888 <br> 09975937774 <br> 09175507848</a>
            </div>
            <div class="col-md-2">
                <h4 class="text-white"><i class="fa fa-envelope"></i> Email</h4>
                <a href="artswork00@gmail.com" class="text-white mb-5">artswork00@gmail.com</a>

            </div>
            <div class="col-md-3">
                <h4 class="text-white"><i class="fa fa-facebook-official"></i> Facebook Page</h4>
                <a href="https://www.facebook.com/ArtzworkPc"  target="_blank" class="text-white">https://www.facebook.com/ArtzworkPc</a>
            </div>
            <div class="col-md-3"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3857.910465101671!2d121.04458790000001!3d14.774073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397af3a75eca673%3A0xe27b688620e701db!2sArtzwork%20PC%20Computer%20Parts%20and%20Services!5e0!3m2!1sen!2sph!4v1716137278702!5m2!1sen!2sph" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
        </div>
    </div>
</div>
<div class="py-2 bg-danger">
    <div class="text-center">
        <p class="mb-0 text-white"> All rights reserved. Copyright @ <a href="https://www.facebook.com/jelooooooooo/" target="_blank" class="text-white">Rio Anjelo Capina</a> - <?= date('Y')?></p>
    </div>
</div>



<?php include('includes/footer.php'); ?>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    });
</script>
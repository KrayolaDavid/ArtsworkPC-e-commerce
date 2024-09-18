<?php
session_start();
include('includes/header.php');
include('config/dbcon.php');


$products = [];
if (isset($_POST['submit'])) {
    $str = $_POST['str'];
    $stmt = $con->prepare("SELECT * FROM products WHERE name LIKE ?");
    $searchTerm = "%$str%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <div class="row">
                        <?php if (count($products) > 0): ?>
                            <?php foreach ($products as $item): ?>
                                <div class="col-md-3 mb-2">
                                    <a href="product-view.php?product=<?= ($item['slug']) ?>">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <img src="upproduct/<?= ($item['image']) ?>" alt="Product Image" class="w-100">
                                                <?php 
                                                    $productName = $item['name'];
                                                    if(strlen($productName) > 20) {
                                                        $productName = substr($productName, 0, 15). '...';
                                                    }
                                                ?>
                                                <h4 class="text-center text-decoration-none"><?= $productName ?></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No products found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<?php include('includes/footer.php')?>

<?php 
include('includes/header.php');
include('../middleware/adminmiddleware.php')
?>

<div class="container">
    <div class="row">
        <div class="com-md-12">
            <?php
                if(isset($_GET['id']))
                {

                $id = $_GET['id'];
                $products = getByID("products", $id);

                if(mysqli_num_rows($products) > 0)
                {
                    $data = mysqli_fetch_array($products);
                    ?>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product
                        <a href="products.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-select mb-2">
                                    <option selected>Select Category</option>
                                    <?php
                                            $components = getAll("components");

                                            if(mysqli_num_rows($components) > 0)
                                            {
                                                foreach ($components as $item) 
                                                {
                                                    ?>
                                    <option value="<?= $item['id']; ?>"
                                        <?= $data['category_id'] == $item['id'] ? 'selected' : '' ?>><?= $item['name']; ?>
                                    </option>
                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                echo "No categories available";
                                            }
                                        ?>
                                </select>
                            </div>
                            <input type="hidden" name="product_id" value="<?= $data['id']; ?>">
                            <div class="col-md-6">
                                <label class="mb-0" for="name">Name</label>
                                <input type="text" id="name" name="name" value="<?= $data['name']; ?>"
                                    placeholder="Enter Product Name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" value="<?= $data['slug']; ?>"
                                    placeholder="Enter Slug" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0" for="small_description">Small Description</label>
                                <textarea id="small_description" rows="2" name="small_description"
                                    placeholder="Enter Small Description"
                                    class="form-control mb-2"><?= $data['small_description']; ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0" for="description">Description</label>
                                <textarea id="description" rows="3" name="description" placeholder="Enter Description"
                                    class="form-control mb-2"><?= $data['description']; ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="original_price">Original Price</label>
                                <input type="text" id="original_price" name="original_price"
                                    value="<?= $data['original_price']; ?>" placeholder="Enter Original Price"
                                    class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0" for="image">Upload Image</label>
                                <input type="hidden" name="old_image" value="<?= $data['image']; ?>">
                                <input type="file" id="image" name="image" class="form-control mb-2">
                                <label class="mb-0" for="image">Current Image</label>
                                <img src="../upproduct/<?= $data['image']; ?>" alt="Product Image" height="50px"
                                    width="50px">
                                
                            </div>
                            <a href="https://imageresizer.com/" target="_blank">Image Resizer</a>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mb-0" for="qty">Quantity</label>
                                    <input type="number" id="qty" name="qty" value="<?= $data['qty']; ?>"
                                        placeholder="Enter Quantity" class="form-control mb-2">
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0">Status</label> <br>
                                    <input type="checkbox" name="status" <?= $data['status'] == '0' ? '' : 'checked' ?>>
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0">Trending</label> <br>
                                    <input type="checkbox" name="trending" <?= $data['trending'] == '0' ? '' : 'checked' ?>>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="container">Meta Title</label>
                                <input type="text" id="meta_title" name="meta_title" value="<?= $data['meta_title']; ?>"
                                    placeholder="Enter Meta Title" class="form-control mb-2">
                            </div>

                            <div class="col-md-12">
                                <label class="mb-0">Meta Description</label>
                                <textarea id="meta_description" rows="3" name="meta_description"
                                    class="form-control mb-2"><?= $data['meta_description']; ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta Keywords</label>
                                <textarea id="meta_keywords" rows="3" name="meta_keywords"
                                    class="form-control mb-2"><?= $data['meta_keywords']; ?></textarea>
                            </div>

                            <div class="col-md-6">
                                <button class="btn bg-danger" name="update_product_button"
                                    style="color:black;">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                } 
                else
                {
                    echo "Product not found for ID";
                } 
            }
            else
            {
                echo "ID missing in URL";
            }
            ?>
        </div>
    </div>
</div>

<?php include('Includes/footer.php')?>
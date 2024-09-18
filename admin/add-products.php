<?php 
include('includes/header.php');
include('../middleware/adminmiddleware.php')
?>

<div class="container">
    <div class="row">
        <div class="com-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Producs</h4>
                </div>

                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Edit Products</label>
                                <select name="category_id"class="form-select mb-2" >
                                <option selected>Select Category</option>
                                    <?php
                                        $components = getAll("components");

                                        if(mysqli_num_rows($components) > 0)
                                        {

                                        
                                            foreach ($components as $item) 
                                            {
                                                ?>
                                                    <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo"No";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-0"for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter Product Name"
                                    class="form-control mb-2">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="mb-0"for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" placeholder="Enter Slug"
                                    class="form-control mb-2">
                            </div>

                            <div class="col-md-12">
                                <label class="mb-0"for="">Small Description</label>
                                <textarea id="description" rows="2" name="small_description"
                                    placeholder="Enter Description" class="form-control mb-2"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="mb-0"for="description">Description</label>
                                <textarea id="description" rows="3" name="description"
                                    placeholder="Enter Description" class="form-control mb-2"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-0"for="">Original Price</label>
                                <input type="text" id="name" name="original_price" placeholder="Enter Original Price"
                                    class="form-control mb-2">
                            </div>

                            <div class="col-md-6">
                                <label class="mb-0"for="">Selling Price</label>
                                <input type="text" id="slug" name="selling_price" placeholder="Enter Selling Price"
                                    class="form-control mb-2">
                            </div>

                            <div class="col-md-12">
                                <label class="mb-0"for="image">Upload Image</label>
                                <input type="file" id="image" name="image" class="form-control mb-2">
                                <a href="https://imageresizer.com/" target="_blank">Image Resizer</a>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mb-0"for="">Quantity</label>
                                    <input type="number" id="slug" name="qty" placeholder="Enter Quantity"
                                        class="form-control mb-2">
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0">Status</label> <br>
                                    <input type="checkbox"   id="status" name="status">
                                </div>
                                <div class="col-md-3">
                                    <label  class="mb-0">Treding</label> <br>
                                    <input type="checkbox"  id="trending" name="treding">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="container" >Meta Title</label>
                                <input type="text" id="meta_title" name="meta_title" placeholder="Enter Category Meta Title"
                                    class="form-control mb-2">
                            </div>

                            <div class="col-md-12">
                                <label class="mb-0">Meta Description</label>
                                <textarea id="meta_description" rows="3" name="meta_description" placeholder="Enter Category Meta Description" class="form-control mb-2"></textarea>
                            </div>             
                            <div class="col-md-12">
                                <label class="mb-0">Meta Keywords</label>
                                <textarea id="meta_keywords" rows="2" name="meta_keywords"
                                    placeholder="Enter Category Meta Keywords" class="form-control mb-2"></textarea>
                            </div>
                            
                            <div class="col-md-6">
                                <button class="btn bg-danger" name="add_product_button" style="color:black;">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<?php include('Includes/footer.php')?>
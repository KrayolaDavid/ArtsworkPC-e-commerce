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
                $category = getByID("components", $id);

                if(mysqli_num_rows($category) > 0)
                {
                    $data = mysqli_fetch_array($category);
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Components
                                <a href="category.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                            
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter Category Slug"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="description">Description</label>
                                        <textarea id="description" rows="3" name="description" 
                                            placeholder="Enter Description" class="form-control"><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="image">Upload Image</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                        <label for="image">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <img src="../uploads/<?= $data['image'] ?>"  width="50px" height="50px" alt="">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" id="meta_title" value="<?= $data['meta_title'] ?>" name="meta_title" placeholder="Enter Category Meta Title"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea id="meta_description" rows="3" name="meta_description"
                                            placeholder="Enter Category Meta Description" class="form-control"><?= $data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <textarea id="meta_keywords" rows="3" name="meta_keywords"
                                            placeholder="Enter Category Meta Keywords" class="form-control"><?= $data['meta_keywords'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">Status</label>
                                        <input type="checkbox" id="status" <?= $data['status'] ? "checked":"" ?> name="status">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="popular">Popular</label>
                                        <input type="checkbox" id="popular" <?= $data['popular'] ? "checked":"" ?> name="popular">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn bg-danger" name="update_category_button" style="color:black;">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                }
                else
                {
                    echo"Component not found";
                }
            }
            else 
            {
                echo "Id missing from url";
            }
                ?>
        </div>
    </div>
</div>
</div>
</div>


<?php include('Includes/footer.php')?>
<?php 

include('includes/header.php');
include('../middleware/adminmiddleware.php')

?>

<div class="container">
    <div class="row">
        <div class="com-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Components</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter Category Name"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" placeholder="Enter Category Slug"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea id="description" rows="3" name="description"
                                    placeholder="Enter Category Description" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="image">Upload Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" id="meta_title" name="meta_title" placeholder="Enter Category Meta Title"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="meta_description">Meta Description</label>
                                <textarea id="meta_description" rows="3" name="meta_description"
                                    placeholder="Enter Category Meta Description" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea id="meta_keywords" rows="3" name="meta_keywords"
                                    placeholder="Enter Category Meta Keywords" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="status">Status</label>
                                <input type="checkbox" id="status" name="status">
                            </div>
                            <div class="col-md-6">
                                <label for="popular">Popular</label>
                                <input type="checkbox" id="popular" name="popular">
                            </div>
                            <div class="col-md-12">
                                <button class="btn bg-danger" name="add_category_button" style="color:black;">Save</button>
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
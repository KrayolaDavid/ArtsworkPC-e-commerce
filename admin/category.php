<?php 

include('includes/header.php');
include('../middleware/adminmiddleware.php')


?>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Components</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        
                            $category = getAll("components");
                            if(mysqli_num_rows($category) > 0)
                            {
                                foreach($category as $item)
                                {
                                    ?>
                            <tr>
                                <td><?= $item['id']; ?></td>
                                <td><?= $item['name']; ?></td>
                                <td>
                                    <img src="../uploads/<?= $item['image']; ?>" width="50px" height="50px"
                                        alt="<?= $item['name']; ?>">
                                </td>
                                <td><?= $item['status'] == '0'? "Visible":"Hidden"?></td>
                                <td>
                                    <div class="button-container">
                                        <a href="edit-category.php?id=<?= $item['id']; ?>"
                                            class="btn btn-danger">Edit</a>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                            <button type="submit" class="btn btn-primary"
                                                name="delete_category_btn">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                <style>
                                    .button-container {
                                        display: flex;
                                        gap: 10px;
                                        /* Adjust the value as needed to control the spacing */
                                    }
                                </style>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            else
                            {
                                echo"No Records Founds";
                            }

                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('Includes/footer.php')?>
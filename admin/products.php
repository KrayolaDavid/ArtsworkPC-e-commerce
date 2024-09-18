<?php
include('includes/header.php');
include('../middleware/adminmiddleware.php');
include('../function/prod.php');

$categories = getAll("components");

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                    <div>
                        <label for="categoryFilter">Filter by Category:</label>
                        <select id="categoryFilter" class="form-control">
                            <option value="all">All</option>
                            <?php
                            if (mysqli_num_rows($categories) > 0) {
                                foreach ($categories as $category) {
                                    echo "<option value='{$category['name']}'>{$category['name']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="category-change-section">
                        <label for="newCategory">Change Category To:</label>
                        <select id="newCategory" class="form-control">
                            <?php
                            $categories = getAll("components");
                            if (mysqli_num_rows($categories) > 0) {
                                foreach ($categories as $category) {
                                    echo "<option value='{$category['id']}'>{$category['name']}</option>";
                                }
                            }
                            ?>
                        </select>
                        <button id="changeCategoryBtn" class="btn btn-primary mt-2">Change Category</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            <?php
                            $products = getAll("products");
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                                    ?>
                            <tr data-product-id="<?= $item['id']; ?>">
                                <td><input type="checkbox" class="product-checkbox" value="<?= $item['id']; ?>"></td>
                                <td><?= $item['id']; ?></td>
                                <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                    <?= $item['name']; ?>
                                </td>
                                <td><?= getCategoryName($item['category_id']); ?></td>
                                <td>
                                    <img src="../upproduct/<?= $item['image']; ?>" width="50px" height="50px"
                                        alt="<?= $item['name']; ?>">
                                </td>
                                <td><?= $item['qty']; ?></td>
                                <td><?= $item['status'] == '0'? "Visible":"Hidden"?></td>
                                <td>
                                    <div class="button-container">
                                        <a href="edit-products.php?id=<?= $item['id']; ?>"
                                            class="btn btn-danger">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No Records Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
    document.getElementById('categoryFilter').addEventListener('change', function () {
        var filterValue = this.value.toLowerCase();
        var rows = document.querySelectorAll('#productTable tr');

        rows.forEach(function (row) {
            var categoryCell = row.querySelector('td:nth-child(4)').innerText.toLowerCase();
            if (filterValue === 'all' || categoryCell === filterValue) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    document.getElementById('changeCategoryBtn').addEventListener('click', function () {
        var selectedCategory = document.getElementById('newCategory').value;
        var selectedCategoryText = document.getElementById('newCategory').options[document.getElementById(
            'newCategory').selectedIndex].text;
        var selectedProducts = [];

        document.querySelectorAll('.product-checkbox:checked').forEach(function (checkbox) {
            selectedProducts.push(checkbox.value);
        });

        if (selectedProducts.length > 0) {
            // Send data to the server
            fetch('change-category.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        category_id: selectedCategory,
                        product_ids: selectedProducts
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the UI without refreshing the page
                        selectedProducts.forEach(function (productId) {
                            document.querySelector(
                                    `tr[data-product-id='${productId}'] td:nth-child(4)`)
                                .innerText = selectedCategoryText;
                        });
                    } else {
                        console.error('Error:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            console.log('Please select at least one product.');
        }
    });
</script>

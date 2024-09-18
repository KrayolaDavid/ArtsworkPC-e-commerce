<?php
include('function/userfunction.php');
include('authenticate.php'); 
?>


<?php $items = getSelectedItems();
    foreach($items as $citem) { ?>
<div class="card product_data shadow-sm mb-2 ">
    <div class="row align-items-center  ">
        <div class="col-md-2">
            <img src="upproduct/<?= $citem['image'] ?>" alt="Image" width="120px">
        </div>
        <div class="col-md-4 ">
            <h5><?= $citem['name'] ?></h5>
        </div>
        <div class="col-md-2">
            <h5>₱<?= $citem['original_price'] ?></h5>
        </div>
        <div class="col-md-2">
            <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
            <div class="input-group mb-3" style="width: 130px;">
                <button class="input-group-text decrement-btn updateQty">-</button>
                <input type="text" class="form-control input-qty bg-white text-center" value="<?= $citem['prod_qty'] ?>"
                    disabled>
                <button class="input-group-text increment-btn updateQty">+</button>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-danger deleteItem" value="<?= $citem['cid'] ?>">Remove</button>
        </div>
    </div>
</div>
<?php } ?>
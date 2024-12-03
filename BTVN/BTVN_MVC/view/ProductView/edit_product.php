<!-- Link Bootstrap 5 -->
<link rel="stylesheet" href="./asset/css/bootstrap.min.css">
<!-- Edit product -->
<form class="form-group"
    action="index.php?controller=Product&action=handleEditProduct&id=<?=htmlspecialchars($products['id'])?>"
    method="post" enctype="multipart/form-data">
    <div class="header">
        <h4>EDIT PRODUCT</h4>
    </div>
    <div class="body">
        <div>
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($products['name']) ?>"
                maxlength="50" required>
        </div>
        <div>
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" value="<?= htmlspecialchars($products['price']) ?>"
                min="1000" required>
        </div>
        <div>
            <label for="image" class="form-label">Image</label>
            <img src="<?= htmlspecialchars($products['image']) ?>" style="max-width: 200px;">
            <input class="my-2" type="file" name="image">
        </div>
        <!-- Index hidden -->
        <input type="hidden" name="id" value="<?=htmlspecialchars($products['id'])?>">
    </div>
    <div class="footer py-2">
        <button type="submit" class="btn btn-default" name="editProductBtn" value="Cancel">Cancel</button>
        <button type="submit" class="btn btn-success" name="editProductBtn" value="Save">Save</button>
    </div>
</form>
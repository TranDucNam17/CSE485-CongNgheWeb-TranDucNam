<!-- Link Bootstrap 5 -->
<link rel="stylesheet" href="./asset/css/bootstrap.min.css">
<!-- Add product -->
<form class="form-group" action="index.php?controller=Product&action=handleAddProduct" method="post"
    enctype="multipart/form-data">
    <div class="header">
        <h4>ADD NEW PRODUCT</h4>
    </div>
    <div class="body">
        <div>
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" maxlength=50 required>
        </div>
        <div>
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" name="price" id="price" min=1000 required>
        </div>
        <div>
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" name="image">
        </div>
    </div>
    <div class="footer m-2">
        <button class="btn btn-default" name="addProductBtn" value="Cancel">Cancel</button>
        <button type="submit" class="btn btn-success" name="addProductBtn" value="Add">Add</button>
    </div>
</form>
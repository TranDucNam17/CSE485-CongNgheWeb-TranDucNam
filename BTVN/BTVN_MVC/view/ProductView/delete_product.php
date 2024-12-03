<!-- Link Bootstrap 5 -->
<link rel="stylesheet" href="./asset/css/bootstrap.min.css">
<!-- Delete Product -->
<form action="index.php?controller=Product&action=handleDeleteProduct&id=<?=htmlspecialchars($_GET['id'])?>"
    method="post">
    <h4>YOU SURE DELETE PRODUCT</h4>
    <!-- Index hidden -->
    <input type="hidden" name="id" value="<?=htmlspecialchars($_GET['id'])?>">
    <button type="submit" class="btn btn-default" name="delProductBtn" value="Cancel">Cancel</button>
    <button type="submit" class="btn btn-danger" name="delProductBtn" value="Yes">Yes</button>
</form>
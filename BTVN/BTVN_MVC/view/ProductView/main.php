<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<style>
.action-column {
    width: 100px;
}
</style>

<body>
    <main>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Image</th>
                    <th class="text-center action-column">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" class="py-3 text-center">No products</td>
                </tr>
                <?php else: ?>
                <?php $count = 1; ?>
                <?php foreach ($products as $id=>$value): ?>
                <tr>
                    <td class="text-center py-5"><?= htmlspecialchars($count++) ?></td>
                    <td class="text-center py-5"><?= htmlspecialchars($value['name']) ?></td>
                    <td class="text-center py-5"><?= htmlspecialchars($value['price']) ?> VND</td>
                    <td class="text-center" style="width:150px">
                        <img src="<?php echo htmlspecialchars($value['image'])?>"
                            style="max-height:120px; max-width: 150px;">
                    </td>
                    <td class="text-center action-column text-nowrap py-5">
                        <a href="index.php?controller=Product&action=editProduct&id=<?= urlencode($value['id']); ?>"
                            class="btn btn-warning">Edit</a>
                        <a href="index.php?controller=Product&action=deleteProduct&id=<?= urlencode($value['id']); ?>"
                            class="btn btn-danger">Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>

</html>
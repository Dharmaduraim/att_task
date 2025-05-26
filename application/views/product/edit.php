<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Product</h2>
    <form method="post" enctype="multipart/form-data" action="<?= base_url('product/update/'.$product->id) ?>">

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" value="<?= set_value('name', $product->name) ?>">
            <?= form_error('name', '<small class="text-danger">', '</small>') ?>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description"  class="form-control"><?= set_value('description',$product->description) ?></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="<?= set_value('price',$product->price) ?>">
            <?= form_error('price', '<small class="text-danger">', '</small>') ?>
        </div>

        <div class="mb-3">
           <label>Category</label> 
<select name="category_id" class="form-select">
    <option value="">-- Select Category --</option>
    <?php foreach ($categories as $cat): ?>
        <option value="<?= $cat->id ?>" <?= $cat->id == $product->category_id ? 'selected' : '' ?>>
            <?= $cat->name ?>
        </option>
    <?php endforeach; ?>
</select>  </div>



        <div class="mb-3">
            <label>Image</label>
             <?php if ($product->image): ?>
                        <img src="<?= base_url('uploads/' . $product->image) ?>" width="80">
                    <?php endif; ?>
            <input type="file" name="image" value="<?= base_url($product->image) ?>" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="<?= base_url('product') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>

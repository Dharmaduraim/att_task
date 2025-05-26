<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Welcome, <?= $this->session->userdata('user')['username'] ?>!</h3>
    </div>
<div class="container mt-4">
    <h2>Add New Product</h2>
   <?php if (!empty($upload_error)): ?>
    <div class="alert alert-danger"><?= $upload_error ?></div>
<?php endif; ?>


    <form method="post" enctype="multipart/form-data" action="<?= base_url('product/store') ?>">

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
            <?= form_error('name', '<small class="text-danger">', '</small>') ?>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"><?= set_value('description') ?></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="<?= set_value('price') ?>">
            <?= form_error('price', '<small class="text-danger">', '</small>') ?>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select">
                <option value="">-- Select Category --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="<?= base_url('product') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>

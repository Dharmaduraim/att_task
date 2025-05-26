
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-3">Jewellery Product List</h3>
 <div class="container mt-5">
        <h3>Welcome, <?= $this->session->userdata('user')['username'] ?>!</h3>
    </div>
    <!-- <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#productModal" onclick="openAddModal()">Add Product</button> -->
    <button class="btn btn mb-3" ><a href='<?= base_url('product/create')?>'>Add Product</a></button>
    <button class="btn btn mb-3" ><a href='<?= base_url('auth/logout')?>'>Logout</a></button>

    <table id="productTable" class="table table-bordered">
        <thead>
            <tr>

                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                 <th>Description</th> 
                <th>Image</th>    
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- add Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="<?= base_url('product/store') ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

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

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
$(document).ready(function () {
     const baseUrl = "<?= base_url() ?>";
    window.table = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('product/get_products') ?>",
            type: "POST"
        },
        columns: [
        
            { data: 'name' },
            { data: 'price' },
            { data: 'category_name' },
             { data: 'description' },
            {
                data: 'image',
                render: function (data) {
                    return `<img src="${baseUrl}uploads/${data}" width="60">`;
                },
                orderable: false
            },

            {
                data: 'id',
                render: function (data) {
                    return `
                        <a href="<?= base_url('product/edit/') ?>${data}" class="btn btn-sm btn-primary" >edit</a>
                        <br><a href="<?= base_url('product/delete/') ?>${data}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    `;
                },
                orderable: false
            }
        ],
        dom: 'Bfrtip',
        buttons: ['colvis']
    });
});

function openAddModal() {
    $('#productForm')[0].reset();
    $('#product_id').val('');
    $('#productModalLabel').text('Add Product');
    $('#currentImage').html('');
}
$('#productForm').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        url: "<?= base_url('product/save') ?>",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function () {
            $('#productModal').modal('hide');
            $('#productForm')[0].reset();
            table.ajax.reload();
        }
    });
});

function openEditModal(id) {
    $.get("<?= base_url('product/edit/') ?>" + id, function(res) {
        $('#product_id').val(res.id);
        $('#name').val(res.name);
        $('#description').val(res.description);
        $('#price').val(res.price);
        $('#category_id').val(res.category_id);
        $('#productModalLabel').text('Edit Product');

        if (res.image) {
            $('#currentImage').html('<img src="<?= base_url() ?>' + res.image + '" width="100">');
        } else {
            $('#currentImage').html('');
        }

        $('#productModal').modal('show');
    }, 'json');
}

</script>
</body>
</html>

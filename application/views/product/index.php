<!DOCTYPE html>
<html>
<head>
    <title>Jewellery Products</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
</head>
<body>
    <h2>Jewellery Products</h2>
    <a href="<?= site_url('product/create') ?>">Add Product</a>
    <table id="productTable" class="display" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?= site_url('product/fetch') ?>',
                    type: 'POST'
                },
                dom: 'Bfrtip',
                buttons: [
                    'colvis'
                ],
            });
        });
    </script>
</body>
</html>

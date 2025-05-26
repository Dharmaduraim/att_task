<!DOCTYPE html>
<html>
<head>
    <title>Upload Success</title>
</head>
<body>

<h3>Your image was successfully uploaded!</h3>

<ul>
    <li>File Name: <?php echo $upload_data['file_name']; ?></li>
    <li>File Type: <?php echo $upload_data['file_type']; ?></li>
    <li>File Size: <?php echo $upload_data['file_size']; ?> KB</li>
</ul>

<img src="<?php echo base_url('uploads/' . $upload_data['file_name']); ?>" style="max-width:300px;"/>

</body>
</html>

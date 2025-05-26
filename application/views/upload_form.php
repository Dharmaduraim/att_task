<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>

<?php if (isset($error)) echo $error; ?>

<?php echo form_open_multipart('upload/do_upload'); ?>

    <input type="file" name="userfile" size="20" />

    <br /><br />

    <input type="submit" value="Upload" />

</form>

</body>
</html>

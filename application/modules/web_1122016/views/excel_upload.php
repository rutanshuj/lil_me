<!DOCTYPE html>
<html>
<body>

<form action="<?php echo base_url('admin/Uploader/excel_upload');?>" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
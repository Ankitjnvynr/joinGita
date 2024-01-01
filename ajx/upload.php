<style>
    .image-container:hover .image-delete {
        display: inline-block;
    }
</style>
<?php
if (is_array($_FILES)) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $sourcePath = $_FILES['userImage']['tmp_name'];
        $targetPath = "images/" . $_FILES['userImage']['name'];
        if (move_uploaded_file($sourcePath, $targetPath)) {
            ?>
            <div class="image-container"><img src="<?php echo $targetPath; ?>" width="100px" height="100px" />
                <div class="image-delete" onClick="deleteImage('<?php echo $targetPath; ?>')">X</div>
            </div>
            <?php
        }
    }
}
?>
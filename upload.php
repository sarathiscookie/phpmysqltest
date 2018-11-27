<?php require 'includes/header.php'; ?>

<body>

<?php require 'includes/navigation.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php require 'includes/sidebar.php'; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Upload XLS</h1>
            <form action="upload.php" method="post">
                <div class="form-group">
                    <label for="inputFile">File input</label>
                    <input type="file" id="inputFile">
                </div>

                <button type="submit" class="btn btn-default" name="uploadFile">Upload File</button>
            </form>
        </div>

    </div>
</div>

<?php require 'includes/footer.php'; ?>

<?php
if(isset($_POST['uploadFile']))
{
    require 'database/connection.php';

}
?>


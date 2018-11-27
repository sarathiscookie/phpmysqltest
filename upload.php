<?php require 'includes/header.php'; ?>

<body>

<?php require 'includes/navigation.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php require 'includes/sidebar.php'; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Upload XLS</h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
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

    if ($_FILES["file"]["error"] > 0)
    {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br>";

        $a        = $_FILES["file"]["tmp_name"];

        $connect  = mysql_connect('localhost','root','');
        if (!$connect) {
            die('Could not connect to MySQL: ' . mysql_error());
        }

        $cid      = mysql_select_db('test',$connect);

        $csv_file = $a;

        if (($getfile = fopen($csv_file, "r")) !== FALSE) {
            $data         = fgetcsv($getfile, 1000, ",");

            while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
                $result   = $data;
                $str      = implode(",", $result);
                $slice    = explode(",", $str);

                $col1 = $slice[0];
                $col2 = $slice[1];
                $col3 = $slice[2];
                $col4 = $slice[3];

                $query = "INSERT INTO persons(id, name, email ,contacts) VALUES('".$col1."','".$col2."','".$col3."','".$col4."')";
                $s     = mysql_query($query, $connect );
            }

        }

        echo "<script>alert('Record successfully uploaded.');window.location.href='jobDetails.php';</script>";

        mysql_close($connect);
    }

}
?>


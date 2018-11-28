<!-- Header -->
<?php require 'includes/header.php'; ?>

<body>

<!-- Navigation -->
<?php require 'includes/navigation.php'; ?>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <?php require 'includes/sidebar.php'; ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Upload XLS</h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputFile">File input</label>
                    <input type="file" id="file" name="file">
                </div>

                <button type="submit" class="btn btn-default" name="upload">Upload File</button>
            </form>
        </div>

    </div>
</div>

<!-- Footer -->
<?php require 'includes/footer.php'; ?>

<?php

if(isset($_POST['upload'])) {
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        $allowedExtensions  = array("xls","xlsx");
        $ext                = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if(in_array($ext, $allowedExtensions)) {
            $file_size      = $_FILES['file']['size'] / 1024;
            if($file_size < 50) {
                $file       = "uploads/".$_FILES['file']['name'];
                $isUploaded = copy($_FILES['file']['tmp_name'], $file);
                if($isUploaded) {
                    include("database/db.php");
                    include("Classes/PHPExcel/IOFactory.php");
                    try {
                        //Load the excel(.xls/.xlsx) file
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                    } catch (Exception $e) {
                        die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
                    }

                    //An excel file may contains many sheets, so we have to specify which one we need to read or work with.
                    $sheet = $objPHPExcel->getSheet(0);
                    //It returns the highest number of rows
                    $total_rows = $sheet->getHighestRow();
                    //It returns the highest number of columns
                    $highest_column = $sheet->getHighestColumn();

                    echo '<h4>Data from excel file</h4>';
                    echo '<table cellpadding="5" cellspacing="1" border="1" class="responsive" style="margin-left: 200px;">';

                    $query = "insert into job_details (job_id, job_title, date_time) VALUES ";
                    //Loop through each row of the worksheet
                    for($row =2; $row <= $total_rows; $row++) {
                        //Read a single row of data and store it as a array.
                        //This line of code selects range of the cells like A1:D1
                        $single_row = $sheet->rangeToArray('A' . $row . ':' . $highest_column . $row, NULL, TRUE, FALSE);
                        echo "<tr>";
                        //Creating a dynamic query based on the rows from the excel file
                        $query .= "(";
                        //Print each cell of the current row
                        foreach($single_row[0] as $key=>$value) {
                            echo "<td>".$value."</td>";
                            $query .= "'".$mysqli->real_escape_string($value)."',";
                        }
                        $query = substr($query, 0, -1);
                        $query .= "),";
                        echo "</tr>";
                    }
                    $query = substr($query, 0, -1);
                    echo '</table>';

                    // At last we will execute the dynamically created query an save it into the database
                    $mysqli->query($query);
                    if($mysqli->affected_rows > 0) {
                        echo '<span class="msg">Database table updated!</span>';
                    } else {
                        echo '<span class="msg">Can\'t update database table! try again.</span>';
                    }
                    // Finally we will remove the file from the uploads folder (optional)
                    unlink($file);

                    $mysqli->close();
                } else {
                    echo '<span class="msg">File not uploaded!</span>';
                }
            } else {
                echo '<span class="msg">Maximum file size should not cross 50 KB on size!</span>';
            }
        } else {
            echo '<span class="msg">This type of file not allowed!</span>';
        }
    } else {
        echo '<span class="msg">Select an excel file first!</span>';
    }
}
?>


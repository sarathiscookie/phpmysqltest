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
            <h1 class="page-header">GD Library</h1>


        </div>

    </div>
</div>

<?php
$tableWidth = 150 . 'px';
$width      = 20 . 'px';
$height     = 20 . 'px';

$image = "<table width=".$tableWidth." style='margin-left: 200px;'>";
for($i=0; $i < 8; $i++){
    $image .= "<tr>";
    for($j=0; $j < 8; $j++){
        if($i % 2 == 0){
            if($j % 2 == 0){
                $image .= '<td style="background-color: pink; width: '.$width.'; height: '.$height.'"></td>';
            } else {
                $image .= '<td style="background-color: black; width: '.$width.'; height: '.$height.'"></td>';
            }
        } else {
            if($j % 2 == 0){
                $image .= '<td style="background-color: black; width: '.$width.'; height: '.$height.'"></td>';
            } else {
                $image .= '<td style="background-color: pink; width: '.$width.'; height: '.$height.'"></td>';
            }
        }
    }
    $image .= "</tr>";
}
$image .= "<table>";

$im               = @imagecreate(300, 600)
or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 0, 0, 0);
$text_color       = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 1, 5, 5,  $image, $text_color);
//imagettftext($img, 9, 0, 1, 1, $white, "VERDANA.TTF", $html_code);
header("Content-Type: image/png");
imagepng($im, 'img/chessboard.png');
?>
<!-- Footer -->
<?php require 'includes/footer.php'; ?>
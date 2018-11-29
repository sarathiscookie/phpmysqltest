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

            <div class="col-sm-6">
                <form action="" method="get">
                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="number" name="height" id="height" class="form-control" placeholder="Height">
                    </div>
                    <div class="form-group">
                        <label for="width">Width</label>
                        <input type="number" name="width" id="width" class="form-control" placeholder="Width">
                    </div>
                    <div class="form-group">
                        <label for="fieldWidth">Field Width</label>
                        <input type="number" name="fieldWidth" id="fieldWidth" class="form-control" placeholder="Field Width">
                    </div>
                    <button type="submit" class="btn btn-default" name="generateImage">Generate Image</button>
                </form>

                <?php
                if(isset($_REQUEST['generateImage'] )) {
                    //header('Content-type: image/png');

                    $imageCreate = @imagecreate(400, 400)
                    or die("Cannot Initialize new GD image stream");
                    $grey        = imagecolorallocate($imageCreate, 229, 229, 229);
                    $black       = imagecolorallocate($imageCreate,0,0,0);
                    $white       = imagecolorallocate($imageCreate,255,255,255);
                    $fieldWidth  = (!empty($_REQUEST['fieldWidth'])) ? $_REQUEST['fieldWidth'] : 50;

                    imagefilltoborder($imageCreate, 0, 0, $grey, $grey);

                    imagefill($imageCreate,50,20, $white);

                    for ($i = 1; $i < 8; $i++) {
                        $cord = $i * $fieldWidth;
                        imageline($imageCreate,0, $cord,400, $cord, $black);
                        imageline($imageCreate, $cord,0, $cord,400, $black);
                    }

                    for ($i = 0; $i < 8; $i++)  {
                        for ($j = 0; $j < 8; $j++)  {
                            $x = ($i * $fieldWidth) + 2;
                            $y = ($j * $fieldWidth) + 2;
                            if ( (($i % 2) + ($j % 2) ) % 2 == 0 ) {
                                imagefill($imageCreate, $x, $y, $black);
                            }
                        }
                    }

                    imagepng($imageCreate, 'img/chessboard.png');
                    imagedestroy($imageCreate);
                    ?>
                    <h1>Image will find out in "img/chessboard.php" folder</h1>
                    <img src="img/chessboard.png" alt="chessboard" width="400" height="400">
                    <?php
                }
                ?>

            </div>

        </div>

    </div>
</div>

<!-- Footer -->
<?php require 'includes/footer.php'; ?>
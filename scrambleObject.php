<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/30/2018
 * Time: 7:18 AM
 */

require 'vendor/autoload.php';

use App\scrambleTextClass;

$scramble = new scrambleTextClass;

header('Content-Type: application/json');

/* Scramble Forward*/
if( isset($_REQUEST['forward']) && $_REQUEST['txt'] !== '' )
{
    $forwardResult   = $scramble->scrambleForward($_REQUEST['txt']);
    echo json_encode($forwardResult);
}

/* Scramble Reverse*/
if( isset($_REQUEST['reverse']) && $_REQUEST['txt'] !== '' )
{
    $reverseResult   = $scramble->scrambleReverse($_REQUEST['txt']);
    echo json_encode($reverseResult);
}


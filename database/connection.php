<?php
try {
    $dbh      = new PDO('mysql:host=localhost;dbname=phpmysqltest', 'root', 'root');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
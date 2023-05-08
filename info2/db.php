<?php
function getDb(){
    $connection = mysqli_connect("localhost:3307", "root", "")
        or die("Kapcsolódási hiba: " . mysqli_error($connection));
    mysqli_select_db($connection, "info2");
    mysqli_query($connection, "set character_set_results='utf8'");

    return $connection;
}
?>
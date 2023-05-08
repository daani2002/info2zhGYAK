<?php
    include 'db.php';
    session_start();

   if(isset($_GET['id'])){
        $connection = getDb();
        $id = $_GET['id'];
        $_SESSION['del'] = $id;

        $exist = "SELECT id nev FROM telefonkonyv WHERE id=" . mysqli_real_escape_string($connection, $id);
        
        if($exist)
        {
        $query = "DELETE FROM telefonkonyv WHERE id=" . mysqli_real_escape_string($connection, $id);
        mysqli_query($connection, $query);
        mysqli_close($connection);
        }
   }
   header("Location: index.php");
?>
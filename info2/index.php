<?php 
    session_start();
    if ( isset($_SESSION['Id'])) 
    {
        $message = "Sikeres beírás";
        $_SESSION['Id'] = null;
    }
    else if ( isset($_SESSION['del'])) 
    {
        $message = "Sikeres törlés";
        $_SESSION['del'] = null;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Telefonkönyv</title>
       <link rel="stylesheet" type="text/css" href="theme.css">   
    </head>
    <body>
        <?php
            include 'db.php';
            $connection = getDb();
            $eredmeny = mysqli_query($connection, "SELECT id, nev, szam FROM telefonkonyv");
        ?>
        <h1>Telefonkönyv</h1>
        <table>
            <tr>
                <th>#</th>
                <th>Név</th>
                <th>Telefon</th>     
                <th></th> 
            </tr> 
            <?php while($row = mysqli_fetch_array($eredmeny)): ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['nev']?></td>
                    <td><?=$row['szam']?></td>
                    <td><a href="delete.php?id=<?=$row['id']?>">Töröl</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <?php
            mysqli_close($connection);
        ?>
        <p>
           <a href="insert.php">Új elem beszúrása</a>    
        </p>
        <?php if ($message): ?>
        <p> <?=$message?> </p>
        <?php endif;?>
    </body>
</html>

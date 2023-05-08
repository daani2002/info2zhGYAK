<?php
    include 'db.php';

    session_start();

    if(isset($_POST['uj']) and isset($_POST['nev']) and isset($_POST['szam'])){
        $connection = getDb();
        $nev = $_POST['nev'];
        if($nev == "")
            $message = "Írja be a nevét!";
        else{
        $_SESSION['Id'] = $nev;
        $szam = $_POST['szam'];
        $query = sprintf("INSERT INTO telefonkonyv(nev, szam) VALUES('%s', '%s')"
                            , mysqli_real_escape_string($connection, $nev)
                            , mysqli_real_escape_string($connection, $szam));
        mysqli_query($connection, $query);
        mysqli_close($connection);
        header("Location: index.php");
        }
        
    }
?>

<!DOCTYPE html>
<html>
    <head><title>Telefonkönyv</title></head>
    <body>
        <form action="insert.php" method="post">
            <h1>Új telefonszám</h1>
            <p>
                Név: <input type="text" name="nev" />    
            </p>
            <p>
                Telefonszám: <input type="text" name="szam" />    
            </p>
            <p> 
                <input type="submit" value="Elküld" name="uj" />
            </p>
            <?php if ($message): ?>
            <p> <?=$message?> </p>
            <?php endif;?>
        </form>
    </body>
</html>


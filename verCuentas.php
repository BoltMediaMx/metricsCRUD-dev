<?php
    require 'database.php';

    $id = null;

    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ($id == null) { 
        header("Location: indexCommunity.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM bm_community_managers where idCommunity = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $dataCommunity = $q->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM metricas_facebook where idCommunity = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $dataMetrics = $q->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 community-profile">
            <?php 
                echo '<img class="foto-perfil" src='.$dataCommunity['nombreCommunity'].'.png alt="">'
            ?>
            <h3> <?php echo $dataCommunity['nombreCommunity']; ?> </h3>
            <h4> Rendimiento </h4>
            <ul> <!-- TODO rendimientos-->
                <li>Facebook: </li>
                <li>Instagram: </li>
                <li>Twitter: </li>
                <li>Youtube: </li>
            </ul>
        </div>
    </div>    
    <div class="row options">
        <a class="btn btn-info" href="index.html">Volver</a>
    </div>
</div>
</body>
</html>
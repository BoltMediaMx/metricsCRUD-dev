<?php
    require 'database.php';

    $id = null;

    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ($id == null) { 
        header("Location: indexCliente.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM cuenta_facebook where idCuentaFacebook = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $cuenta = $q->fetch(PDO::FETCH_ASSOC);
        
        $sql2 = "SELECT * FROM bm_community_managers where idCommunityManager = ?";
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($cuenta['idCommunityManager']));
        $community = $q2->fetch(PDO::FETCH_ASSOC);

        $sql3 = "SELECT * FROM clientes where idCliente = ?";
        $q3 = $pdo->prepare($sql3);
        $q3->execute(array($cuenta['idCliente']));
        $cliente = $q3->fetch(PDO::FETCH_ASSOC);

        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="style.css">
</head>

<body id="bootstrap-overrides">
<div class="container">
    <div class="row metrics-header">
        
            
            <div class="col-md-5 col-md-offset-1 nombre-cliente-col">
                <div class="row nombre-cliente-col">
                <?php echo '<h1>'.$cliente['nombreCliente'].'</h1>'; ?>
                </div>
            </div>
            <div class="col-md-2 col-md-offset-2">
                <img class="img-responsive" src="recursos/facebook-logo.png" alt="">
            </div>
            <div class="col-md-4">
                <?php echo '<img class="img-responsive" src="recursos/logos-clientes/'.$cliente['nombreCliente'].'.png" alt="">'; ?>
            </div>
        
    </div>
    <hr> <hr>
    <div class="row body-row">
        <div class="col-md-2">
            <div class="container community-profile">
            <p> <?php echo '<img class="img-responsive" src="recursos/fotos-community/'.$community['nombreCommunity'].'.jpg" alt="">'; ?> </p>
            <p> <?php echo '<h4>'.$community['nombreCommunity'].'</h4>'; ?> </p>
            <p> Score: <?php //calculateScore ?> </p>
            </div>
        </div>
        <div class="col-md-9 col-md-offset-1 metrics">
            <!-- replace all this -->
            <div class="row metrics-container">
                <div class="col-md-3">
                    <p> Actions on Page: <?php echo $cuenta['actionsOnPage']; ?> </p>
                    <p> Page Followers: <?php echo $cuenta['pageFollowers']; ?> </p>
                </div>
                <div class="col-md-3">
                    <p> Page Likes: <?php echo $cuenta['pageLikes']; ?> </p>
                    <p> Page Previews: <?php echo $cuenta['pagePreviews']; ?> </p>
                    <p> Page Views: <?php echo $cuenta['pageViews']; ?> </p>
                </div>
                <div class="col-md-3">
                    <p> Post Engagements: <?php echo $cuenta['postEngagements']; ?> </p>
                    <p> Reach: <?php echo $cuenta['reach']; ?> </p>
                </div>
            </div>
        </div>    
    </div>
</div>
</body>
</html>
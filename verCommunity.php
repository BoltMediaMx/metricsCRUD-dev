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
        $sql = "SELECT * FROM bm_community_managers where idCommunityManager = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3>Ver Community Manager</h3>
        </div>

        <div class ="form-horizontal">
            <div class="control-group">
                <label class="control-label">Nombre</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['nombreCommunity'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Direccion</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['direccionCommunity'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Correo Electronico</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['correoCommunity'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Telefono</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['telefonoCommunity'];?>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn btn-info" href="indexCommunity.php">Volver</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
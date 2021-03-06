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
        $sql = "SELECT * FROM clientes where idCliente = ?";
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
            <h3>Ver Cliente</h3>
        </div>

        <div class ="form-horizontal">
            <div class="control-group">
                <label class="control-label">Nombre</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['nombreCliente'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Direccion</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['direccionCliente'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Correo Electronico</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['correoCliente'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Telefono</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['telefonoCliente'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Contacto</label>
                <div class="controls">
                    <label class="checkbox">
                        TODO
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Sitio Web</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo '<a href='.$data['sitioWebCliente'].'>'.$data['sitioWebCliente'].'</a>'?>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn btn-info" href="indexCliente.php">Volver</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
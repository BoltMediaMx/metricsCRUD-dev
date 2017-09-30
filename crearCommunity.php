<?php
    require 'database.php';

    

    if (!empty ($_POST)) {
        $nombreCommunityError = null;
        $direccionError = null;
        $emailError = null;
        $telefonoError = null;

        $valid = true;

        $nombreCommunity = $_POST['nombreCommunity'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        if (empty($nombreCommunity)) {
            $nombreCommunityError = 'Porfavor ingrese un nombre';
            $valid = false;
        }
        if (empty($direccion)) {
            $direccionError = 'Porfavor ingrese una direccion';
            $valid = false;
        }
        if (empty($telefono)) {
            $telefonoError = 'Porfavor ingrese un numero telefonico';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO bm_community_managers (nombreCommunity,direccionCommunity,correoCommunity,telefonoCommunity) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombreCommunity,$direccion,$email,$telefono));
            Database::disconnect(); 
            header("Location: indexCommunity.php");
        }
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
                <h3>Crear un Community Manager nuevo</h3>
            </div>
            <form class="form-horizontal" action="crearCommunity.php" method="post">
                <div class="control-group <?php echo !empty($nombreCommunityError)?'error':'';?>">
                    <label class="control-label">Nombre del Community Manager</label>
                    <div class="controls">
                        <input name="nombreCommunity" type="text" placeholder="Nombre"
                        value="<?php echo !empty($nombreCommunity)?$nombreCommunity:'';?>">
                        <?php if (!empty($nombreCommunityError)): ?>
                            <span class="help-inline"><?php echo $nombreCommunityError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($direccionError)?'error':'';?>">
                    <label class="control-label">Direccion</label>
                    <div class="controls">
                        <input name="direccion" type="text" placeholder="Direccion" 
                        value="<?php echo !empty($direccion)?$direccion:'';?>">
                        <?php if (!empty($direccionError)): ?>
                            <span class="help-inline"><?php echo $direccionError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                    <label class="control-label">Correo Electronico</label>
                    <div class="controls">
                        <input name="email" type="text" placeholder="Correo Electronico de Contacto" 
                        value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                <div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
                    <label class="control-label">Numero de telefono de contacto</label>
                    <div class="controls">
                        <input name="telefono" type="text"  placeholder="XXXXXXXXX" 
                        value="<?php echo !empty($telefono)?$telefono:'';?>">
                        <?php if (!empty($telefonoError)): ?>
                            <span class="help-inline"><?php echo $telefonoError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Crear</button>
                    <a class="btn" href="indexCommunity.php">Volver</a>
                </div>
            </form>
        </div>
    </div> <!-- /container -->
</body>
</html>

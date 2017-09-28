<?php
    require 'database.php';

    if (!empty ($_POST)) {
        $nombreClienteError = null;
        $direccionError = null;
        $emailError = null;
        $telefonoError = null;

        $valid = true;

        $nombreCliente = $_POST['nombreCliente'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        if (empty($nombreCliente)) {
            $nombreClienteError = 'Porfavor ingrese un nombre';
            $valid = false;
        }
        if (empty($direccion)) {
            $direccionError = 'Porfavor engrese una direccion';
            $valid = false;
        }
        if (empty($email)) {
            $emailError = 'Porfavor ingrese un correo electronico';
            $valid = false;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = 'Porfavor ingrese un correo electronico valido';
            $valid = false;
        }
        if (empty($telefono)) {
            $telefonoError = 'Porfavor ingrese un numero telefonico';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO cliente (nombre,direccion,email,telefono) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombreCliente,$direccion,$email,$telefono));
            Database::disconnect(); 
            header("Location: indexCliente.php");
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
                <h3>Crear un cliente nuevo</h3>
            </div>
            <form class="form-horizontal" action="crearCliente.php" method="post">
                <div class="control-group <?php echo !empty($nombreClienteError)?'error':'';?>">
                    <label class="control-label">Nombre del Cliente</label>
                    <div class="controls">
                        <input name="nombreCliente" type="text" placeholder="Nombre del Cliente"
                        value="<?php echo !empty($nombreCliente)?$nombreCliente:'';?>">
                        <?php if (!empty($nombreClienteError)): ?>
                            <span class="help-inline"><?php echo $nombreClienteError;?></span>
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
                    <a class="btn" href="indexCliente.php">Atras</a>
                </div>
            </form>
        </div>
    </div> <!-- /container -->
</body>
</html>

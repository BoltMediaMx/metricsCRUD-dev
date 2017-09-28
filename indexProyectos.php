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
        $sql = "SELECT * FROM proyecto where idCliente = ?";
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
        <div class="row header">
            <h3> Proyectos </h3>
        </div>
        <div class="row content">
            <?php
                echo '<a class="btn btn-success" href="crearProyecto.php?id='.$id.'">Crear un Proyecto</a>';
            ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-head">
                        <!-- Informacion sobre los clientes -->
                        <th>Proyecto</th>
                        <th>Fecha de Creacion</th>
                        <th>Fecha de Entrega</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php 
                        $pdo = Database::connect();
                        $sql2 = 'SELECT * FROM proyecto where id = '.$id.' ORDER BY id DESC';
                        foreach($pdo->query($sql2) as $row) {
                            echo '<tr>';
                            echo '<td>'.$row['nombre'].'</td>';
                            echo '<td>'.$row['fechaCreacion'].'</td>';
                            echo '<td>'.$row['fechaEntrega'].'</td>';
                            echo '<td><a class="btn" href="verProyecto.php?id='.$row['id'].'">Ver</a></td>';
                            echo '</tr>';
                        }
                        Database::disconnect();     
                    ?>  
                </tbody>
            </table> 
        </div><!-- /table -->
    </div><!-- /container -->
</body>
</html>
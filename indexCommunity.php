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
            <h3> Community Managers </h3>
        </div>
        <div class="row content">
            <a href="crearCommunity.php" class="btn btn-success">Añadir Community Manager</a>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-head">
                        <!-- Informacion sobre los clientes -->
                        <th>Nombre</th>
                        <th>Correo Electronico</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php 
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM bm_community_managers ORDER BY idCommunityManager DESC';
                        foreach($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'.$row['nombreCommunity'].'</td>';
                            echo '<td>'.$row['correoCommunity'].'</td>';
                            echo '<td>'.$row['direccionCommunity'].'</td>';
                            echo '<td>'.$row['telefonoCommunity'].'</td>';
                            echo '<td><a class="btn" href="verCommunity.php?id='.$row['idCommunityManager'].'">Ver</a></td>';
                            echo '</tr>';
                        }
                        Database::disconnect();     
                    ?>  
                </tbody>
            </table> 
        </div><!-- /table -->
        <div class="row">
            <a class="btn btn-info" href="index.html">Volver</a>
        </div>
    </div><!-- /container -->
</body>
</html>
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
            <h3> Clientes </h3>
        </div>
        <div class="row content">
            <a href="crearCliente.php" class="btn btn-success">Crear cliente nuevo</a>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-head">
                        <!-- Informacion sobre los clientes -->
                        <th>Cliente</th>
                        <th>Direccion</th>
                        <th>Correo Electronico</th>
                        <th>Telefono</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php 
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM cliente ORDER BY id DESC';
                        foreach($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'.$row['nombre'].'</td>';
                            echo '<td>'.$row['direccion'].'</td>';
                            echo '<td>'.$row['email'].'</td>';
                            echo '<td>'.$row['telefono'].'</td>';
                            echo '<td><a class="btn" href="verCliente.php?id='.$row['id'].'">Ver</a></td>';
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
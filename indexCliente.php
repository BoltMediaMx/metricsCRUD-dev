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
                        <th>Contacto</th>
                        <th>Sitio Web</th>
                        <th>Accion</th>

                    </tr>
                </thead>
                <tbody> 
                    <?php 
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM clientes ORDER BY idCliente DESC';
                        foreach($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'.$row['nombreCliente'].'</td>';
                            echo '<td>'.$row['direccionCliente'].'</td>';
                            echo '<td>'.$row['correoCliente'].'</td>';
                            echo '<td>'.$row['telefonoCliente'].'</td>';
                            echo '<td>TODO</td>';
                            echo '<td> <a href='.$row['sitioWebCliente'].'>'.$row['sitioWebCliente'].'</a></td>';
                            echo '<td><a class="btn" href="verCliente.php?id='.$row['idCliente'].'">Ver</a></td>';
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
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
            <h3> Cuentas de Facebook </h3>
        </div>
        <div class="row content">
            <a href="crearCuentaFacebook.php" class="btn btn-success">Añadir cuenta nueva</a>
            <div class="buffer-vertical" style="margin-top:30px"></div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-head">
                        <th>Cuenta</th>
                        <th>Cliente</th>
                        <th>Community Manager</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php 
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM cuenta_facebook ORDER BY idCuentaFacebook DESC';
                        foreach($pdo->query($sql) as $row) {
                            $communityQuery = 'SELECT nombreCommunity FROM bm_community_managers WHERE idCommunity = ?';
                            $clienteQuery = 'SELECT nombreCliente FROM clientes WHERE idCliente = ?';
                            $qCommunity = $pdo->prepare($communityQuery);
                            $qCliente = $pdo->prepare($clienteQuery);

                            $qCommunity->execute(array($row['idCommunityManager']));
                            $nombreCommunity = $qCommunity->fetch(PDO::FETCH_ASSOC);
                            $qCliente->execute(array($row['idCliente']));
                            $nombreCliente = $qCliente->fetch(PDO::FETCH_ASSOC);

                            echo '<tr>';
                            echo '<td>'.$row['nombreCuenta'].'</td>';
                            echo '<td>
                                    <a href="verCliente.php?id='.$row['idCliente'].'">'.$nombreCliente.'</a>
                                  </td>';
                            echo '<td>
                                    <a href="verCommunity.php?id='.$row['idCommunityManager'].'">'.$nombreCommunity.'</a>
                                  </td>';
                            echo '<td><a class="btn" href="verCuentaFacebook.php?id='.$row['idCuentaFacebook'].'">Ver</a></td>';
                            echo '</tr>';
                        }
                        Database::disconnect();     
                    ?>  
                </tbody>
            </table> 
        </div><!-- /table -->
        <div class="row options">
            <a class="btn btn-info" href="index.html">Volver</a>
        </div>
    </div><!-- /container -->
</body>
</html>
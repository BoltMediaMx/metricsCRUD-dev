<?php
    require 'database.php';

    if (!empty ($_POST)) {
        $nombreCuentaInstagramError = null;
        $favoritesAddedError = null;
        $favoritesLostError = null;
        $commentsError = null;
        $likesError = null;
        $minutesWatchedError = null;
        $sharesError = null;
        $followersGainedError = null;
        $followersLostError = null;
        $viewDurationError = null;
        $viewsError = null;

        $valid = true;
        $nombreCuentaInstagram = $_POST['nombreCuentInstagram'];
        $favoritesAdded = $_POST['favoritesAdded'];
        $favoritesLost = $_POST['favoritesLost'];
        $comments = $_POST['comments'];
        $likes = $_PPOST['likes'];
        $minutesWatched = $_POST['minutesWatched'];
        $shares = $_POST['shares'];
        $followersGained = $_POST['followersGained'];
        $followersLost = $_POST['followersLost'];
        $viewDuration = $_POST['viewDuration'];
        $views = $_POST['views'];
        $idCliente = $_POST['idCliente'];
        $idCommunityManager = $_POST['idCommunityManager'];

        if (empty($nombreCuentaInstagram)) {
            $nombreCuentaInstagramError = 'Porfavor ingrese un nombre';
            $valid = false;
        }
        if (empty($favoritesAdded)) {
            $favoritesAddedError = 'Porfavor ingrese la cantidad de Favorites Added';
            $valid = false;
        }
        if (empty($favoritesLost)) {
            $favoritesLostError = 'Porfavor ingrese la cantidad de Page Likes';
            $valid = false;
        } 
        if (empty($comments)) {
            $commentsError = 'Porfavor ingrese la cantidad de Comments';
            $valid = false;
        }
        if (empty($likes)) {
            $likesError = 'Porfavor ingrese la cantidad de Likes';
            $valid = false;
        }
        if (empty($minutesWatched)) {
            $minutesWatchedError = 'Porfavor ingrese la cantidad de Minutes Watched';
            $valid = false;
        }
        if (empty($shares)) {
            $sharesError = 'Porfavor ingrese la cantidad de Shares';
            $valid = false;
        }
        if (empty($followersGained)) {
            $followersGainedError = 'Porfavor ingrese la cantidad de Followers Gained';
            $valid = false;
        }
        if (empty($followersLost)) {
            $followersLostError = 'Porfavor ingrese la cantidad de Followers Lost';
            $valid = false;
        }
        if (empty($viewDuration)) {
            $viewDurationError = 'Porfavor ingrese la cantidad de View Duration';
            $valid = false;
        }
        if (empty($views)) {
            $viewsError = 'Porfavor ingrese la cantidad de Views';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO cuenta_instagram (nombreCuentaInstagram,comments,favoritesAdded,favoritesLost,followersGained,followersLost,likes,minutesWatched,shares,viewDuration,views,idCliente,idCommunityManager) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombreCuentaInstagram,$comments,$favoritesAdded,$favoritesLost,$followersGained,$followersLost,$likes,$minutesWatched,$shares,$viewDuration,$views,$idCliente,$idCommunityManager));
            Database::disconnect(); 
            header("Location: indexCuentasInstagram.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Añadir Cuenta de Instagram</h3>
            </div>
            <form class="form-horizontal" action="crearCuentaInstagram.php" method="post">
                <div class="control-group row <?php echo !empty($nombreCuentaInstagramError)?'error':'';?>">
                    <label class="control-label col-md-5">Nombre de la Cuenta</label>
                    <div class="controls col-md-7">
                        <input name="nombreCuentaInstagram" type="text"
                        value="<?php echo !empty($nombreCuentaInstagram)?$nombreCuentaInstagram:'';?>">
                        <?php if (!empty($nombreCuentaInstagramError)): ?>
                            <span class="help-inline"><?php echo $nombreCuentaInstagramError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($commentsError)?'error':'';?>">
                    <label class="control-label col-md-5">Comments</label>
                    <div class="controls col-md-7">
                        <input name="comments" type="text" 
                        value="<?php echo !empty($comments)?$comments:'';?>">
                        <?php if (!empty($commentsError)): ?>
                            <span class="help-inline"><?php echo $commentsError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($favoritesAddedError)?'error':'';?>">
                    <label class="control-label col-md-5">Favorites Added</label>
                    <div class="controls col-md-7">
                        <input name="favoritesAdded" type="text" 
                        value="<?php echo !empty($favoritesAdded)?$favoritesAdded:'';?>">
                            <?php if (!empty($favoritesAddedError)): ?>
                                <span class="help-inline"><?php echo $favoritesAddedError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                <div class="control-group row <?php echo !empty($favoritesLostError)?'error':'';?>">
                    <label class="control-label col-md-5">Page Previews</label>
                    <div class="controls col-md-7">
                        <input name="favoritesLost" type="text" 
                        value="<?php echo !empty($favoritesLost)?$favoritesLost:'';?>">
                        <?php if (!empty($favoritesLostError)): ?>
                            <span class="help-inline"><?php echo $favoritesLostError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($followersGainedError)?'error':'';?>">
                    <label class="control-label col-md-5">Followers Gained</label>
                    <div class="controls col-md-7">
                        <input name="followersGained" type="text"
                        value="<?php echo !empty($followersGained)?$followersGained:'';?>">
                        <?php if (!empty($followersGainedError)): ?>
                            <span class="help-inline"><?php echo $followersGainedError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($followersLostError)?'error':'';?>">
                    <label class="control-label col-md-5">Post Engagements</label>
                    <div class="controls col-md-7">
                        <input name="followersLost" type="text" 
                        value="<?php echo !empty($followersLost)?$followersLost:'';?>">
                        <?php if (!empty($followersLostError)): ?>
                            <span class="help-inline"><?php echo $followersLostError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($likesError)?'error':'';?>">
                    <label class="control-label col-md-5">Likes</label>
                    <div class="controls col-md-7">
                        <input name="likes" type="text" 
                        value="<?php echo !empty($likes)?$likes:'';?>">
                        <?php if (!empty($likesError)): ?>
                            <span class="help-inline"><?php echo $likesError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($minutesWatchedError)?'error':'';?>">
                    <label class="control-label col-md-5">Minutes Watched</label>
                    <div class="controls col-md-7">
                        <input name="minutesWatched" type="text" 
                        value="<?php echo !empty($minutesWatched)?$minutesWatched:'';?>">
                        <?php if (!empty($minutesWatchedError)): ?>
                            <span class="help-inline"><?php echo $minutesWatchedError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($SharesError)?'error':'';?>">
                    <label class="control-label col-md-5">Shares</label>
                    <div class="controls col-md-7">
                        <input name="Shares" type="text" 
                        value="<?php echo !empty($Shares)?$Shares:'';?>">
                        <?php if (!empty($SharesError)): ?>
                            <span class="help-inline"><?php echo $SharesError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($viewDurationError)?'error':'';?>">
                    <label class="control-label col-md-5">View Duration</label>
                    <div class="controls col-md-7">
                        <input name="viewDuration" type="text" 
                        value="<?php echo !empty($viewDuration)?$viewDuration:'';?>">
                        <?php if (!empty($viewDurationError)): ?>
                            <span class="help-inline"><?php echo $viewDurationError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group row <?php echo !empty($viewsError)?'error':'';?>">
                    <label class="control-label col-md-5">Views</label>
                    <div class="controls col-md-7">
                        <input name="views" type="text" 
                        value="<?php echo !empty($views)?$views:'';?>">
                        <?php if (!empty($viewsError)): ?>
                            <span class="help-inline"><?php echo $viewsError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="cliente-drop-down control-group row">
                    <label class="control-label col-md-5">Cliente</label>
                    <div class="controls col-md-7">
                        <?php
                            $pdo = Database::connect();
                            $sql = "SELECT * FROM clientes";
                            $result = $pdo->query($sql);

                            echo '<select name="idCliente">';
                            foreach($result as $row) {
                                echo '<option value='.$row['idCliente'].'>'.$row['nombreCliente'].'</option>';
                            }
                            echo '</select>';
                            Database::disconnect();
                        ?>
                    </div>
                </div>
                <div class="community-drop-down control-group row">
                    <label class="control-label col-md-5"> Community Manager</label>
                    <div class="controls col-md-7">
                        <?php
                            $pdo = Database::connect();
                            $sql = "SELECT * FROM bm_community_managers";
                            $result = $pdo->query($sql);

                            echo '<select name="idCommunityManager">';
                            foreach($result as $row) {
                                echo '<option value='.$row['idCommunityManager'].'>'.$row['nombreCommunity'].'</option>';
                            }
                            echo '</select>';
                            Database::disconnect();
                        ?>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Crear</button>
                    <a class="btn btn-info" href="indexCuentasInstagram.php">Volver</a>
                </div>
                
            </form>
        </div>
    </div> <!-- /container -->
</body>
</html>
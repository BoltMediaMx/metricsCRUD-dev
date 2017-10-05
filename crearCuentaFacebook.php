<?php
    require 'database.php';

    if (!empty ($_POST)) {
        $nombreCuentaError = null;
        $pageFollowersError = null;
        $pageLikesError = null;
        $pagePreviewsError = null;
        $pageViewsError = null;
        $postEngagementsError = null;
        $reachError = null;
        $actionsOnPageError = null;

        $valid = true;
        $nombreCuenta = $_POST['nombreCuenta'];
        $pageFollowers = $_POST['pageFollowers'];
        $pageLikes = $_POST['pageLikes'];
        $pagePreviews = $_POST['pagePreviews'];
        $pageViews = $_POST['pageViews'];
        $postEngagements = $_POST['postEngagements'];
        $reach = $_POST['reach'];
        $actionsOnPage = $_POST['actionsOnPage'];
        $idCliente = $_POST['idCliente'];
        $idCommunityManager = $_POST['idCommunityManager'];

        if (empty($nombreCuenta)) {
            $nombreCuentaError = 'Porfavor ingrese un nombre';
            $valid = false;
        }
        if (empty($pageFollowers)) {
            $pageFollowersError = 'Porfavor ingrese la cantidad de Page Followers';
            $valid = false;
        }
        if (empty($pageLikes)) {
            $pageLikesError = 'Porfavor ingrese la cantidad de Page Likes';
            $valid = false;
        } 
        if (empty($pagePreviews)) {
            $pagePreviewsError = 'Porfavor ingrese la cantidad de Page Previews';
            $valid = false;
        }
        if (empty($pageViews)) {
            $pageViewsError = 'Porfavor ingrese la cantidad de Page Views';
            $valid = false;
        }
        if (empty($postEngagements)) {
            $postEngagementsError = 'Porfavor ingrese la cantidad de Post Engagements';
            $valid = false;
        }
        if (empty($reach)) {
            $reachError = 'Porfavor ingrese el Reach de la pagina';
            $valid = false;
        }
        if (empty($actionsOnPage)) {
            $actionsOnPageError = 'Porfavor ingrese la cantidad de Actions on Page';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO cuenta_facebook (nombreCuenta,pageFollowers,pageLikes,pagePreviews,pageViews,postEngagements,reach,actionsOnPage,idCliente,idCommunityManager) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombreCuenta,$pageFollowers,$pageLikes,$pagePreviews,$pageViews,$postEngagements,$reach,$actionsOnPage,$idCliente,$idCommunityManager));
            Database::disconnect(); 
            header("Location: indexCuentasFacebook.php");
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
                <h3>Añadir Cuenta de Facebook</h3>
            </div>
            <form class="form-horizontal" action="crearCuentaFacebook.php" method="post">
                <div class="control-group <?php echo !empty($nombreCuentaError)?'error':'';?>">
                    <label class="control-label">Nombre de la Cuenta</label>
                    <div class="controls">
                        <input name="nombreCuenta" type="text" placeholder="Nombre de la Cuenta"
                        value="<?php echo !empty($nombreCuenta)?$nombreCuenta:'';?>">
                        <?php if (!empty($nombreCuentaError)): ?>
                            <span class="help-inline"><?php echo $nombreCuentaError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($pageFollowersError)?'error':'';?>">
                    <label class="control-label">Page Followers</label>
                    <div class="controls">
                        <input name="pageFollowers" type="text" placeholder="Page Followers" 
                        value="<?php echo !empty($pageFollowers)?$pageFollowers:'';?>">
                        <?php if (!empty($pageFollowersError)): ?>
                            <span class="help-inline"><?php echo $pageFollowersError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($pageLikesError)?'error':'';?>">
                    <label class="control-label">Page Likes</label>
                    <div class="controls">
                        <input name="pageLikes" type="text" placeholder="Page Likes" 
                        value="<?php echo !empty($pageLikes)?$pageLikes:'';?>">
                            <?php if (!empty($pageLikesError)): ?>
                                <span class="help-inline"><?php echo $pageLikesError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                <div class="control-group <?php echo !empty($pagePreviewsError)?'error':'';?>">
                    <label class="control-label">Page Previews</label>
                    <div class="controls">
                        <input name="pagePreviews" type="text"  placeholder="Page Previews" 
                        value="<?php echo !empty($pagePreviews)?$pagePreviews:'';?>">
                        <?php if (!empty($pagePreviewsError)): ?>
                            <span class="help-inline"><?php echo $pagePreviewsError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($pageViewsError)?'error':'';?>">
                    <label class="control-label">Page Views</label>
                    <div class="controls">
                        <input name="pageViews" type="text"  placeholder="Page Views" 
                        value="<?php echo !empty($pageViews)?$pageViews:'';?>">
                        <?php if (!empty($pageViewsError)): ?>
                            <span class="help-inline"><?php echo $pageViewsError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($postEngagementsError)?'error':'';?>">
                    <label class="control-label">Post Engagements</label>
                    <div class="controls">
                        <input name="postEngagements" type="text"  placeholder="Post Engagements" 
                        value="<?php echo !empty($postEngagements)?$postEngagements:'';?>">
                        <?php if (!empty($postEngagementsError)): ?>
                            <span class="help-inline"><?php echo $postEngagementsError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($reachError)?'error':'';?>">
                    <label class="control-label">Reach</label>
                    <div class="controls">
                        <input name="reach" type="text"  placeholder="Reach" 
                        value="<?php echo !empty($reach)?$reach:'';?>">
                        <?php if (!empty($reachError)): ?>
                            <span class="help-inline"><?php echo $reachError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($actionsOnPageError)?'error':'';?>">
                    <label class="control-label">Actions on Page</label>
                    <div class="controls">
                        <input name="actionsOnPage" type="text"  placeholder="Actions on Page" 
                        value="<?php echo !empty($actionsOnPage)?$actionsOnPage:'';?>">
                        <?php if (!empty($actionsOnPageError)): ?>
                            <span class="help-inline"><?php echo $actionsOnPageError;?></span>
                       <?php endif;?>
                    </div>
                </div>
                <div class="cliente-drop-down control-group">
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
                <div class="community-drop-down control-group">
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
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Crear</button>
                    <a class="btn" href="indexCuentasFacebook.php">Volver</a>
                </div>
                
            </form>
        </div>
    </div> <!-- /container -->
</body>
</html>
<?php
    require 'database.php';
    session_start();

    if (!empty($_SESSION['username'])) {
        //check this
        header('location:index.html');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $message = 'El nombre de usuario y contraseña son requeridos';
        }
        else {
            $pdo = Database::connect();
            $sql = $pdo->prepare("SELECT * FROM admin WHERE username=? AND password=?");
            $sql->execute(array($username,$password));
            $results = $sql->fetchAll();

            if (count($results) > 0) {
                $_SESSION['username'] = $username;
                //check this
                header('location:index.html');
            }
            else {
                $message = "Credenciales invalidas";
            }
        }
    }
    Database::disconnect();
?>

<html>
<head>
    <title>Login</title>
</head>
<body class="login-page">
    <h2> Bolt Media Sistema Administrativo </h2>
    <h3> Login </h3>
    <form action="login.php" method="post">
        <label for="username">Usuario</label><input type="username" name="username">
        <label for="password">Contraseña</label><input type="text" name="password">
        <button type="submit">Login</button>
    </form>
</body>
</html>
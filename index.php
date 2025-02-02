<?php
// Archivo principal: index.php
require_once "controller/UsuarioController.php";

session_start();
$controller = new UsuarioController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {

    if ($_POST["action"] == "register") {
        $username = $_POST["username"];
        $password = $_POST["password"];


        if ($controller->registrar($username, $password)) {
            echo "Usuario registrado con éxito";
        } else {
            echo "Error al registrar usuario";
        }
    }


    if ($_POST["action"] == "login") {
        $username = $_POST["username"];
        $password = $_POST["password"];


        $user = $controller->login($username, $password);

        if ($user) {

            $_SESSION["user"] = $user;
            header("location: index.php");
        } else {

            echo "Usuario o contraseña incorrectos";
        }
    }
}


if (isset($_GET["action"]) && $_GET["action"] == "logout") {

    session_destroy();
    header("location: index.php");
}


if (isset($_SESSION["user"])) {

    require_once "view/dashboard.php";
} else {

    require_once "view/login.php";
}

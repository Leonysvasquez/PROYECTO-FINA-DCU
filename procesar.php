<?php
session_start();
require 'dbcon.php';

// Procesar registro de usuario
if(isset($_POST['register'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Verificar si el correo electrónico o el nombre de usuario ya están registrados
    $query = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "El correo electrónico o el nombre de usuario ya están registrados";
        header('Location: index.php');
        exit();
    } else {
        // Hash de la contraseña antes de almacenarla en la base de datos
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el usuario en la base de datos
        $query = "INSERT INTO users (name, email, username, password) VALUES ('$name', '$email', '$username', '$password_hash')";
        if(mysqli_query($con, $query)) {
            $_SESSION['success'] = "¡Registro exitoso!";
            header('Location: body.php');
            exit();
        } else {
            $_SESSION['error'] = "Error al registrar el usuario";
            header('Location: index.php');
            exit();
        }
    }
}

// Procesar inicio de sesión de usuario
if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Obtener el usuario de la base de datos
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verificar la contraseña
        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: body.php');
            exit();
        } else {
            $_SESSION['error'] = "Contraseña incorrecta";
            header('Location: index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Nombre de usuario incorrecto";
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MagtimusPro - Sitio web para iniciar sesión y registrarse">
    <meta name="keywords" content="MagtimusPro, inicio de sesión, registro">
    <title>MagtimusPro - Inicio</title>
    <link rel="stylesheet" href="./asset/css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <h1>MagtimusPro</h1>
    </header>

    <main>

        <div class="contenedor__todo">

            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button type="button" id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button type="button" id="btn__registrarse">Regístrarse</button>
                </div>
            </div>

            <div class="contenedor__login-register">

                <form method="POST" action="procesar.php" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <label for="login_email">Correo Electrónico:</label>
                    <input type="email" name="login_email" id="login_email" placeholder="Correo Electrónico" required>
                    <label for="login_password">Contraseña:</label>
                    <input type="password" name="login_password" id="login_password" placeholder="Contraseña" required>
                    <button type="submit" name="login">Entrar</button>
                </form>

                <form method="POST" action="procesar.php" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <label for="register_name">Nombre Completo:</label>
                    <input type="text" name="register_name" id="register_name" placeholder="Nombre Completo" required>
                    <label for="register_email">Correo Electrónico:</label>
                    <input type="email" name="register_email" id="register_email" placeholder="Correo Electrónico" required>
                    <label for="register_username">Nombre de Usuario:</label>
                    <input type="text" name="register_username" id="register_username" placeholder="Nombre de Usuario" required>
                    <label for="register_password">Contraseña:</label>
                    <input type="password" name="register_password" id="register_password" placeholder="Contraseña" required>
                    <button type="submit" name="register">Regístrarse</button>
                    </div>

</div>

</main>

<footer>
<p>MagtimusPro &copy; 2023</p>
</footer>

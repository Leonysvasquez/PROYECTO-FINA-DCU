<?php
    session_start();
    require 'dbcon.php';

    // Procesar registro de usuario
    if(isset($_POST['register'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Verificar si el correo electrónico ya está registrado
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "El correo electrónico ya está registrado";
        } else {
            // Insertar el usuario en la base de datos
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($con, $query);
            $_SESSION['success'] = "¡Registro exitoso!";
        }
    }

    // Procesar inicio de sesión de usuario
    if(isset($_POST['login'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Verificar si las credenciales son válidas
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 1) {
            $_SESSION['user'] = mysqli_fetch_assoc($result);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['error'] = "Credenciales inválidas";
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student CRUD</title>

    <style>
        /* Estilos para la barra lateral */
        .sidebar {
            width: 200px;
            background-color: #f8f9fa;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
        }

        /* Estilos para la navegación */
        .navbar {
            background-color: #f8f9fa;
        }

        /* Estilos para el pie de página */
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Barra lateral -->
    <div class="sidebar">
        <h3>Sidebar</h3>
        <p>Contenido de la barra lateral</p>
    </div>

    <!-- Contenedor principal -->
    <div class="container-fluid mt-4">
        <!-- Navegación -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Student CRUD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Cuerpo de la página -->
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Details
                            <a href="student-create.php" class="btn btn-primary float-end">Add Students</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Action</th>                           
                                     </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM students";
                                $result = mysqli_query($con, $query);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['phone'] . "</td>";
                                    echo "<td>" . $row['course'] . "</td>";
                                    echo "<td>
                                            <a href='student-edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                                            <a href='student-delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
                                        </td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="row mt-4">
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>What is a CRUD system?</h4>
            </div>
            <div class="card-body">
                <p>Un sistema CRUD es una forma de administrar datos en una base de datos. CRUD significa Crear, Leer, Actualizar y Eliminar, que son las operaciones básicas que se pueden realizar en los datos. En este sistema CRUD para estudiantes, puede agregar nuevos estudiantes, ver estudiantes existentes, actualizar la información de los estudiantes y eliminar estudiantes de la base de datos.</p> </p>
            </div>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>Student CRUD &copy; 2023</p>
    </div>

</div>
    
</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

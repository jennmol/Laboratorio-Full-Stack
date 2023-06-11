<!DOCTYPE html>
<html>
<head>
  <title>Resultado del Registro</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
  <div class="container">
    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "formulario_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Error de conexión: " . $conn->connect_error);
    }

    // Validación de los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Validación en el lado del servidor
    if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($email) || empty($login) || empty($password)) {
      die("Error: Todos los campos son obligatorios.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      die("Error: El formato de email es inválido.");
    }

    if (strlen($password) < 4 || strlen($password) > 8) {
      die("Error: La contraseña debe tener entre 4 y 8 caracteres.");
    }

    // Verificar si el email ya existe en la base de datos
    $checkEmailQuery = "SELECT * FROM usuarios WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
      echo "Error: El email ya está registrado.<br><br>";
      echo '<button class="button-volver" onclick="history.back()">Volver</button>';
    } else {
      // Insertar los datos en la tabla de la base de datos
      $insertQuery = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, login, password) 
                      VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password')";

      if ($conn->query($insertQuery) === TRUE) {
        echo "Registro completado con éxito<br><br>";

        // Botón de consulta
        echo '<button class="button-consulta" onclick="location.href=\'consulta.php\'">Consulta</button>';
      } else {
        echo "Error al registrar los datos: " . $conn->error;
      }
    }

    $conn->close();
    ?>
  </div>
</body>

</html>



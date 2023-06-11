<!DOCTYPE html>
<html>
<head>
  <title>Consulta de usuarios</title>
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

    // Consulta de los usuarios registrados
    $query = "SELECT * FROM usuarios";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Usuarios registrados</h2>";
        echo "<table class='styled-table'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th><th>Password</th></tr>";
      
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>".$row["id"]."</td>";
          echo "<td>".$row["nombre"]."</td>";
          echo "<td>".$row["apellido1"]."</td>";
          echo "<td>".$row["apellido2"]."</td>";
          echo "<td>".$row["email"]."</td>";
          echo "<td>".$row["login"]."</td>";
          echo "<td>".str_repeat("*", strlen($row["password"]))."</td>";
          echo "</tr>";
        }
      
        echo "</table>";
      } else {
        echo "No se encontraron usuarios registrados.";
      }
      
      $conn->close();
      ?>

  </div>
</body>
</html>


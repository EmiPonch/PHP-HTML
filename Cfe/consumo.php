<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Simulador de Consumo CFE</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #eef2f3;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: white;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      width: 350px;
      text-align: center;
    }
    h2 {
      color: #007b5e;
    }
    input {
      width: 90%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background: #007b5e;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
    }
    button:hover {
      background: #009f74;
    }
    .result {
      margin-top: 15px;
      background: #f3fdf8;
      padding: 10px;
      border-radius: 10px;
      border: 1px solid #cdebdc;
    }
    .login {
      background: #222;
      color: white;
      padding: 8px 15px;
      border-radius: 5px;
      cursor: pointer;
      border: none;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <button class="login">Login</button>
    <h2>Simulador CFE</h2>

    <form method="POST">
      <input type="text" name="nombre" placeholder="Nombre del usuario" required><br>
      <input type="text" name="medidor" placeholder="Número de medidor" required><br>
      <input type="number" name="kilowatts" placeholder="Kilowatts usados" required><br>
      <button type="submit" name="calcular">Calcular</button>
    </form>

    <?php
    if (isset($_POST['calcular'])) {
        $nombre = $_POST['nombre'];
        $medidor = $_POST['medidor'];
        $kw = $_POST['kilowatts'];
        $total = 0;

        if ($kw <= 150) {
            $total = $kw * 1.02;
        } elseif ($kw <= 300) {
            $total = (150 * 1.02) + (($kw - 150) * 1.18);
        } elseif ($kw <= 500) {
            $total = (150 * 1.02) + (150 * 1.18) + (($kw - 300) * 3.16);
        } else {
            $total = (150 * 1.02) + (150 * 1.18) + (200 * 3.16) + (($kw - 500) * 3.70);
        }

        echo "<div class='result'>
          <strong>Resultado:</strong><br>
          Usuario: $nombre <br>
          Medidor: $medidor <br>
          Consumo: $kw kWh<br>
          <strong>Total a pagar: $" . number_format($total, 2) . " MXN</strong>
        </div>";
    }
    ?>
  </div>
</body>
</html>

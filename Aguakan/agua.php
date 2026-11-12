<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Simulador de Consumo Aguakan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #e8f7ff;
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
      color: #007acc;
    }
    input {
      width: 90%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background: #007acc;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
    }
    button:hover {
      background: #009ff5;
    }
    .result {
      margin-top: 15px;
      background: #f2fbff;
      padding: 10px;
      border-radius: 10px;
      border: 1px solid #cde9f9;
    }
    .login {
      background: #004d73;
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
    <button class="login" id="btnLogin">Login</button>
    <h2>Simulador Aguakan</h2>

    <form method="POST">
      <input type="text" name="nombre" placeholder="Nombre del usuario" required><br>
      <input type="text" name="cuenta" placeholder="Número de cuenta" required><br>
      <input type="number" name="metros" placeholder="Metros cúbicos usados" required><br>
      <button type="submit" name="calcular">Calcular</button>
    </form>

    <?php
    if (isset($_POST['calcular'])) {
        $nombre = $_POST['nombre'];
        $cuenta = $_POST['cuenta'];
        $m3 = $_POST['metros'];
        $total = 0;

        if ($m3 <= 10) {
            $total = $m3 * 7.00;
        } elseif ($m3 <= 20) {
            $total = (10 * 7.00) + (($m3 - 10) * 9.50);
        } elseif ($m3 <= 40) {
            $total = (10 * 7.00) + (10 * 9.50) + (($m3 - 20) * 15.00);
        } else {
            $total = (10 * 7.00) + (10 * 9.50) + (20 * 15.00) + (($m3 - 40) * 22.00);
        }

        echo "<div class='result'>
          <strong>Resultado:</strong><br>
          Usuario: $nombre <br>
          Cuenta: $cuenta <br>
          Consumo: $m3 m³<br>
          <strong>Total a pagar: $" . number_format($total, 2) . " MXN</strong>
        </div>";
    }
    ?>
  </div>
</body>
</html>

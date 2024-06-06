<?php 
require_once('db.php');

$stmt = $pdo->query('SELECT Total_Prise FROM orderr');
$results = $stmt->fetch(PDO::FETCH_ASSOC);
$FullPrice = $results['Total_Prise'];


$stmt = $pdo->query('SELECT SUM(Prise) AS Total_DopPrice FROM DopUslug');
$results = $stmt->fetch(PDO::FETCH_ASSOC);
$DopPrice = $results['Total_DopPrice'];

if ($DopPrice !== null) {
    $FullPrice += $DopPrice;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спасибо за использование наших услуг</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Спасибо за то, что пользуетесь нашими услугами</h1>
        <div class="form-group">
            <label for="answer">Сумма к оплате за месяц:</label>
            <span><?php echo $FullPrice; ?></span>
        </div>

        <a href="index.php">Вернуться назад</a>
    </div>
</body>
</html>

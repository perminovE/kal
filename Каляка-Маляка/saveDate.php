<?php 
    require_once("db.php");

    $month = $_POST['month'];
    $fio = $_POST['FIO'];
    $countDay = $_POST['CountDay'];
    $dop = $_POST['Dop'];

    $stmt = $pdo->query('select * from DopUslug');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM `DopUslug` WHERE DopUslug.id = :Prise";
    $total = $dop;
    $query = $pdo->prepare($sql);
    $query->bindValue(':Prise', $total, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $monthNew = 0;

    switch ($month) {
        case 1:
            $monthNew = 600;
            if ($countDay > 31)
                $countDay = 31;
            break;
        case 2:
            $monthNew = 600;
            if ($countDay > 29)
                $countDay = 29;
            break;
        case 3:
            $monthNew = 400;
            if ($countDay > 31)
                $countDay = 31;
            break;
        case 4:
            $monthNew = 400;
            if ($countDay > 30)
                $countDay = 30;
            break;
        case 5:
            $monthNew = 400;
            if ($countDay > 31)
                $countDay = 31;
            break;
        case 6:
            $monthNew = 300;
            if ($countDay > 30)
                $countDay = 30;
            break;
        case 7:
            $monthNew = 300;
            if ($countDay > 31)
                $countDay = 31;
            break;
        case 8:
            $monthNew = 300;
            if ($countDay > 31)
                $countDay = 31;
            break;
        case 9:
            $monthNew = 400;
            if ($countDay > 30)
                $countDay = 30;
            break;
        case 10:
            $monthNew = 400;
            if ($countDay > 31)
                $countDay = 31;
            break;
        case 11:
            $monthNew = 400;
            if ($countDay > 30)
                $countDay = 30;
            break;
        case 12:
            $monthNew = 600;
            if ($countDay > 31)
                $countDay = 31;
            break;        
    }

    foreach($results as $item)
    {
        $Sum = $monthNew * $countDay + $item['Price'];
        echo $item['Price'] . "Цена за доп услугу";
    }


    echo $month . "Номер месяца <br>";
    echo $monthNew . "Цена за месяц <br>";
    echo $fio . "ФИО <br>";
    echo $countDay . "Количество дней <br>";
    echo $dop . "Номер доп услуги <br>";
    echo $Sum . "Сумма за все <br>";

    if (!empty($monthNew) && !empty($fio) && !empty($countDay) && !empty($dop)) {
        $stmt = $pdo->prepare("INSERT INTO orderr (fio,	day,	mouth,	id_DopUslug,	Total_Prise) VALUES (?,?,?,?,?)");
        $stmt->execute([
            $fio,
            $countDay,
            $month,
            $dop,
            $Sum
        ]);
    } else {
        $error = true;
        echo "<script>alert(\"Вы ввели не все данные!\");</script>"; 
        return;
    }

    header("Location: display.php");
?>
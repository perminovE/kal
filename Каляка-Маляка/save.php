<?php 
    require_once("db.php");

    $month = $_POST['month'];
    $fio = $_POST['FIO'];
    $countDay = $_POST['CountDay'];
    $dop = $_POST['Dop'];

    $stmt = $pdo->query('select * from дополнительныеуслуги');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM `дополнительныеуслуги` WHERE дополнительныеуслуги.код = :Цена";
    $total = $dop;
    $query = $pdo->prepare($sql);
    $query->bindValue(':Цена', $total, PDO::PARAM_INT);
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

    switch ($dop) {
        case 1:
            $Sum = $monthNew * $countDay+600; 
            break;
        case 2:
            $Sum = $monthNew * $countDay+500; 
            break;
        case 3:
            $Sum = $monthNew * $countDay+1000;
            break;
        case 4:
            $Sum = $monthNew * $countDay;
            break;
        } 
    echo $month . " - Номер месяца <br>";
    echo $monthNew . " - Цена за день <br>";
    echo $fio . " - ФИО <br>" ;
    echo $countDay . " - Количество дней <br>";
    echo $dop . " - Номер доп услуги <br>";
    echo $Sum .  " - Сумма за все <br>";

    if (!empty($monthNew) && !empty($fio) && !empty($countDay) && !empty($dop)) {
        $numm = 1;
        $stmt = $pdo->prepare("INSERT INTO посещаемость (КодМесяца,	ФиоКлиента,	ПосещеноДней,	КодДопУслуги,   стоимость) VALUES (?,?, ?,?,?)");
        $stmt->execute([   
            $month,
            $fio,
            $countDay,
            $dop,
            $Sum
        ]);
        echo "<script>alert(\"Успешно!\");</script>";
    } else {
        $error = true;
        echo "<script>alert(\"Вы ввели не все данные!\");</script>"; 
        return;
    }

    //header("Location: index.php");
?>

https://github/perminovE/kalyak
https://github.com/perminovE/kalyak
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Расчет стоимости</h1>
        <form class="MainForm" action="saveDate.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="idmonth">Месяц</label>
                <select id="idmonth" name="month">
                    <option value="">--Выберите месяц--</option>
                    <option value="1">Январь</option>
                    <option value="2">Февраль</option>
                    <option value="3">Март</option>
                    <option value="4">Апрель</option>
                    <option value="5">Май</option>
                    <option value="6">Июнь</option>
                    <option value="7">Июль</option>
                    <option value="8">Август</option>
                    <option value="9">Сентябрь</option>
                    <option value="10">Октябрь</option>
                    <option value="11">Ноябрь</option>
                    <option value="12">Декабрь</option>
                </select>
            </div>
            <div class="form-group">
                <label for="idPricePerDay">Стоимость 1 дня:</label>
                <input id="idPricePerDay" type="text" name="PricePerDay" readonly>
            </div>
            <div class="form-group">
                <label for="idFIO">ФИО ребенка</label>
                <input id="idFIO" type="text" name="FIO">
            </div>
            <div class="form-group">
                <label for="idCount">Количество дней</label>
                <input id="idCount" type="text" name="CountDay">
            </div>
            <div class="form-group">
                <label for="idDop">Дополнительная услуга</label>
                <select id="idDop" name="Dop">
                    <option value="">--Выберите услугу--</option>
                    <option value="1">Каляка-маляка</option>
                    <option value="2">Веселый мяч</option>
                    <option value="3">Пение</option>
                    <option value="4">Без услуг</option>
                </select>
            </div>
            <div class="form-group">
                <label for="idTotalPrice">Сумма к оплате за месяц</label>
                <input id="idTotalPrice" type="text" name="TotalPrice" readonly>
            </div>
            <div class="buttons-group">
                <button type="button" onclick="clearFields()">Очистить</button>
                <button type="button" onclick="calculate()">Рассчитать</button>
                <button class="SubBut" type="submit">Сохранить</button>
            </div>
        </form>
    </div>

    <script>
        function getPricePerDay(month) {
            if (month === 12 || month === 1 || month === 2) {
                return 400;
            } else if (month === 3 || month === 4 || month === 5 || month === 9 || month === 10 || month === 11) {
                return 300;
            } else if (month === 6 || month === 7 || month === 8) {
                return 500;
            }
            return 0;
        }

        function getAdditionalServicePrice(service) {
            switch (service) {
                case "1":
                    return 3000;
                case "2":
                    return 2000;
                case "3":
                    return 1500;
                case "4":
                    return 0;
                default:
                    return 0;
            }
        }

        function calculate() {
            if (!validateForm()) return;

            const month = parseInt(document.getElementById('idmonth').value);
            const countDays = parseInt(document.getElementById('idCount').value);
            const service = document.getElementById('idDop').value;

            const pricePerDay = getPricePerDay(month);
            const additionalServicePrice = getAdditionalServicePrice(service);
            const totalPrice = (pricePerDay * countDays) + additionalServicePrice;

            document.getElementById('idPricePerDay').value = pricePerDay;
            document.getElementById('idTotalPrice').value = totalPrice;
        }

        function clearFields() {
            document.getElementById('idmonth').value = "";
            document.getElementById('idFIO').value = "";
            document.getElementById('idCount').value = "";
            document.getElementById('idDop').value = "";
            document.getElementById('idPricePerDay').value = "";
            document.getElementById('idTotalPrice').value = "";
        }

        function validateForm() {
            const month = document.getElementById('idmonth').value;
            const fio = document.getElementById('idFIO').value.trim();
            const countDays = document.getElementById('idCount').value.trim();
            const service = document.getElementById('idDop').value;

            if (month === "" || fio === "" || countDays === "" || service === "") {
                alert("Пожалуйста, заполните все поля.");
                return false;
            }

            if (isNaN(countDays) || countDays <= 0) {
                alert("Введите корректное количество дней.");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>
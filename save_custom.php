!DOCTYPE html>
<html>    
<div id="header">
		<p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
             </p>
            <h2> Интернет-магазин "КнигоЛюб"</h2>
             <title>Личные данные заказчика</title>
            </div>
             <div class="clear"></div>
<body> 
<?php
if (!isset($_POST['id_pass']) || !isset($_POST['id_train']) || !isset($_POST['id_wagon']) ||
      !isset($_POST['place']) || !isset($_POST['summ']) || !isset($_POST['departstation']) || !isset($_POST['departtime']) || !isset($_POST['arrivstation']) ||
      !isset($_POST['arrivtime'])) {
        die ("Не все данные введены.<br>
                Пожалуйста, вернитесь назад и закончите ввод");
} 

require_once 'connection.php'; // подключаем скрипт
 $departstation = trim ($_POST['departstation']);
 $arrivstation = trim ($_POST['arrivstation']);
 $departstation = addslashes ( $departstation );
  $arrivstation  = addslashes ( $arrivstation ) ;
  $departdate =  strtotime($_POST['departtime']);
 $arrivdate =  strtotime($_POST['arrivtime']);
   $id_pass = $_POST['id_pass'];
   $id_train = $_POST['id_train'];
   $id_wagon = $_POST['id_wagon'];
   $place=$_POST['place'];
   $summ=$_POST['summ'];
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

$query ="SELECT ID FROM билет WHERE ID_пассажира='$id_pass'";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    
    $myrow = mysqli_fetch_array($result);
	if (!empty($myrow['ID_пассажира'])) {
    exit ("Извините, введённый вами билет уже забронирован. Введите другого.");
    }
$query ="SELECT ID FROM билет ";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$column = mysqli_fetch_array($result);
$new_id = max($column) + 1;
$query ="INSERT INTO `билет`  VALUES('".intval($new_id)."','".intval($id_pass)."', '".$departstation."', '$departdate', '".$arrivstation."', '$arrivdate'
					,'".intval($id_train)."','".intval($id_wagon)."','".intval($place)."','".intval($summ).",T')"; 
	
	
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    // Проверяем, есть ли ошибки
    if ($result)
    {
		 $query ="SELECT * FROM `состав поезда` WHERE ID_поезда='$id_train' AND ID_вагона='$id_wagon'";
		 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		 $row = mysqli_fetch_row($result);
		 $new_zn1 = intval($row[4]) - 1;
		 $new_zn2 = intval($row[5]) + 1;
		 $query ="UPDATE `состав поезда` SET `число свободных мест` = '".$new_zn1."', `число забронированных мест` = '".$new_zn2."' WHERE ID_поезда='$id_train' AND ID_вагона='$id_wagon'";
		 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		echo "Ваш билет успешно забронирован! Вернуться на <a href='index.php'>главную страницу</a>";
    }
 else {
	 
		echo "Ошибка! Ваш данные не сохранены. Вернуться на <a href='index.php'>главную страницу</a>";
    }


?>
</body>
</html>	
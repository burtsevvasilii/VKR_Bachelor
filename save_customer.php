<!DOCTYPE html>
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
   if (!isset($_POST['fio']) || !isset($_POST['address']) ||
      !isset($_POST['email']) ||
    !isset($_POST['phone']) ||
    !isset($_POST['user_id'])){
        die ("Не все данные введены.<br>
                Пожалуйста, вернитесь назад и закончите ввод");
} 
   $fio = trim ($_POST['fio']);
   $address = trim ($_POST['address']); 
   $email = trim ($_POST['email']);
   $fio   = addslashes ( $fio );
   $address  = addslashes ( $address ) ;
   $email  = addslashes ( $email ) ;
   $phone=$_POST['phone']; 
   $user_id=$_POST['user_id']; 
  require_once 'connection.php'; // подключаем скрипт
 $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));    
 // проверка на существование пользователя с таким же логином
 $query ="SELECT `customerid` FROM `customers` WHERE fio='$fio'";
 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    $myrow = mysqli_fetch_array($result);
	if (!empty($myrow['customerid'])) {
    exit ("Извините, введённый вами покупатель уже зарегистрирован. Введите другого.");
    }
	
	 // если такого нет, то сохраняем данные
 $query ="INSERT INTO `customers`  VALUES(NULL,'".intval($user_id)."', '".$fio."', '".$address."', '".$email."', '".intval($phone)."')"; 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    // Проверяем, есть ли ошибки
    if ($result)
    {
    echo "<p>Вы как покупатель-заказчик успешно зарегистрированы! Теперь вы можете заказывать товары. <a href='index.php'>Главная страница</a></p>";
    }
 else {
    echo "<p>Ошибка! Вы не зарегистрированы.</p>";
    }
    ?>
	</body>
</html>	
	
	
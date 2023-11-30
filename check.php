<?php 

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING); // Удаляет все лишнее и записываем значение в переменную //$login
$mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$prava = filter_var(trim($_POST['prava']), FILTER_SANITIZE_STRING);
$status = filter_var(trim($_POST['status']), FILTER_SANITIZE_STRING);

if(mb_strlen($login) < 5 || mb_strlen($login) > 32){
	echo "Недопустимая длина логина";
	#exit();
}
else if(mb_strlen($status) < 5){
	echo "Недопустимая длина статуса.";
	#exit();
} // Проверяем длину имени

$pass = md5($pass."thisisforhabr"); // Создаем хэш из пароля

include ('connection.php'); //подключаемся к БД

$result1 = mysqli_query("SELECT * FROM `users` WHERE `login` = '$login'");
$user1 = mysqli_fetch_assoc(); // Конвертируем в массив
if(!empty($user1)){
	echo "Данный логин уже используется!";
	#exit();
}
$query ="INSERT INTO `users`  VALUES('".intval($prava)."','".$fio."', '".$passport."', '".$address."', '".intval($phone)."','".intval($prava)."')"; 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    // Проверяем, есть ли ошибки
    if ($result)
    {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
#header('Location: /');
echo "Вернуться на <a href='index.php'>главную страницу</a>";
#exit();
 ?>
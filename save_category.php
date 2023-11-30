<!DOCTYPE html>
<html>    
<div id="header">
		<p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
             </p>
            <h2> Интернет-магазин "КнигоЛюб"</h2>
             <title>Поставка нового товара</title>
            </div>
             <div class="clear"></div>
<body> 
<?php
   if (!isset($_POST['category']) ){
        die ("Не все данные введены.<br>
                Пожалуйста, вернитесь назад и закончите ввод");
} 
   $category = trim ($_POST['category']);
   $category  = addslashes ( $category );
   require_once 'connection.php'; // подключаем скрипт
 $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));    
 // проверка на существование пользователя с таким же логином
 $query ="SELECT `catid` FROM `categories` WHERE catname='$category' ";
 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    $myrow = mysqli_fetch_array($result);
	if (!empty($myrow['catid'])) {
    exit ("Извините, введённая вами категория уже есть. Введите другую.");
    }
	 // если такого нет, то сохраняем данные
 $query ="INSERT INTO `categories`  VALUES(NULL,'".$category."')"; 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    // Проверяем, есть ли ошибки
    if ($result)
    {
    echo "<p>Новая категория успешно добавлена! Теперь можно добавлять и продавать книги новой категории. <a href='index.php'>Главная страница</a></p>";
    }
 else {
    echo "<p>Ошибка! Товар не добавлен.</p>";
    }
    ?>
	</body>
</html>	
	
	
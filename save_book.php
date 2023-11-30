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
   if (!isset($_POST['author']) || !isset($_POST['title']) ||
      !isset($_POST['num_cat']) ||
    !isset($_POST['izdatel']) ||
    !isset($_POST['price']) ||
    !isset($_POST['description']) ||
    !isset($_POST['name_image'])){
        die ("Не все данные введены.<br>
                Пожалуйста, вернитесь назад и закончите ввод");
} 
   $author = trim ($_POST['author']);
   $title = trim ($_POST['title']);    
   $izdatel = trim ($_POST['izdatel']);
   $description = trim ($_POST['description']); 
   $author   = addslashes ( $author );
   $title  = addslashes ( $title ) ;
   $izdatel = addslashes ( $izdatel ) ;
   $description = addslashes ( $description ) ;
   $name_image = trim ($_POST['name_image']);
   $name_image   = addslashes ( $name_image );
   $num_cat=$_POST['num_cat'];
   $price=$_POST['price'];   
  require_once 'connection.php'; // подключаем скрипт
 $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));    
 // проверка на существование пользователя с таким же логином
 $query ="SELECT `coun_exempl` FROM `books` WHERE author='$author' AND title='$title' AND izdatel='$izdatel'";
 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 if($result){
    $myrow = mysqli_fetch_row($result);
	if(!empty($myrow)){
	$new_coun = $myrow[0] +1;
	$query ="UPDATE `books` SET `coun_exempl` = '".intval($new_coun)."' WHERE `books`.`id` = ".intval($myrow[0]).""; 
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    // Проверяем, есть ли ошибки
    if ($result)
    {
    echo "<p>Новый товар успешно добавлен! Теперь можно его продавать. <a href='index.php'>Главная страница</a></p>";
    }
 else {
    echo "<p>Ошибка! Товар не добавлен.</p>";
    }
	}
	else{
		$new_coun = 1;
		$query ="INSERT INTO `books`  VALUES(NULL,'".$author."', '".$title."', '".intval($num_cat)."','".$izdatel."','".floatval($price)."','".$description."','".intval($new_coun)."','".$name_image."')"; 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    // Проверяем, есть ли ошибки
    if ($result)
    {
    echo "<p>Новый товар успешно добавлен! Теперь можно его продавать. <a href='index.php'>Главная страница</a></p>";
    }
 else {
    echo "<p>Ошибка! Товар не добавлен.</p>";
    }
	}
 }
  ?>
	</body>
</html>	
	
	
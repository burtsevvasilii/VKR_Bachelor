<!DOCTYPE html>
<html>
    <head>
        <title>Подробная информация о товаре</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
    </head>
    <body> 
        <div id="header">
		   <p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
				<h3>Интернет-магазин "КнигоЛюб"</h3> 
             </p>             
            
             <div class="clear"></div>
        </div>
		<div id="content">          
<?php
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
if(isset($_POST['Название'])) {
$name = $_POST['Название'];
$query = "SELECT `id`,`author`,`title`,`catname`,`izdatel`,`price`,`description`,`coun_exempl`,`image_name` 
FROM `books` JOIN `categories` ON `books`.`catid` = `categories`.`catid` WHERE `books`.`title` = '$name' ";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
	
        $row = mysqli_fetch_row($result);
		$id_book = intval($row[0]);
		 echo ' <td align="center"> <p class="fig" id = "product_image"><img src="images/'.$row[8].'" width="100" height="200" alt=""></p>' ;
        ?>
		<p id = "product_author">Автор: <?php  echo $row[1] ?></p>
		<p id = "product_name">Название:<?php  echo $row[2] ?></p>
		<p id = "product_category">Категория: <?php  echo $row[3] ?></p>
		<p id = "product_izd">Издательство: <?php  echo $row[4] ?></p>
		<p id = "product_price">Цена: <?php  echo $row[5] ?> руб.</p>
		<p id = "product_desc">Описание: <?php  echo $row[6] ?></p>
		<p В наличии: <?php  echo $row[7] ?></p>
		<div id="product_buy"><a href="/">Добавить в корзину </a></div>
		<?php				
			    
$query1 = "SELECT * FROM `shoutbox` WHERE `id_book` = '$id_book'  ";
$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
if($result1)
{
	echo '<h2>Отзывы к товару</h2>';
		echo '<table id = "table" align="center" width="100%" border="1">';
	$rows = mysqli_num_rows($result1); // количество полученных строк
    $columns = mysqli_num_fields($result1); // количество полученных полей
	for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result1);				
		echo "<tr>";
        echo '<td id= "shout_date" align="center">'.date("d.m.Y H:i", strtotime($row[2])).'</td>';
        echo '<td id= "shout_name" align="center">'.$row[3].'</td>';
        echo '<td id= "shout_message" align="center">'.$row[4].'</td>';        	
		echo "</tr>";				
	    }
		echo '</table >';
		}
}
}
else {
if(isset($_POST["submit"])){
         // (1) Место для следующего куска кода 
                      // Проверяем если в глобальном массиве $_POST существуют данные отправленные из формы и заключаем переданные данные в обычные переменные.
            if(isset($_POST["id_book"])){
                //Обрезаем пробелы с начала и с конца строки
                $id_book = filter_var(trim($_POST['id_book']), FILTER_SANITIZE_STRING);

                //Проверяем переменную на пустоту
                if(empty($id_book)){
                     // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите ID_товара</p>";
                    //Возвращаем пользователя на страницу регистрации
                     header("Location: book_1.php");
                    //Останавливаем скрипт
                    exit();
                }
				$id_book = intval($id_book);				
	$query = "SELECT `id`,`author`,`title`,`catname`,`izdatel`,`price`,`description`,`coun_exempl`,`image_name` 
FROM `books` JOIN `categories` ON `books`.`catid` = `categories`.`catid` WHERE `books`.`id` = '$id_book' ";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
		
        $row = mysqli_fetch_row($result);
		$id_book = intval($row[0]);
		 echo ' <td align="center"> <p class="fig"><img src="images/'.$row[8].'" width="100" height="200" alt=""></p>' ;
        ?>
		<p id = "product_author">Автор: <?php  echo $row[1] ?></p>
		<p id = "product_name">Название:<?php  echo $row[2] ?></p>
		<p id = "product_category">Категория: <?php  echo $row[3] ?></p>
		<p id = "product_izd">Издательство: <?php  echo $row[4] ?></p>
		<p id = "product_price">Цена: <?php  echo $row[5] ?> руб.</p>
		<p id = "product_desc">Описание: <?php  echo $row[6] ?></p>
		<p >В наличии: <?php  echo $row[7] ?></p>
		<div id="product_buy"><a href="/">Добавить в корзину </a></div>
		<?php				
}				
            }
			else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с ID_товара</p>";
                //Возвращаем пользователя на страницу регистрации
                header("Location: book_1.php");
                //Останавливаем скрипт
                exit();
            }
			if(isset($_POST["name"])){
                //Обрезаем пробелы с начала и с конца строки
                $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);

                //Проверяем переменную на пустоту
                if(empty($name)){
                     // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваше имя</p>";
                    //Возвращаем пользователя на страницу регистрации
                     header("Location: book_1.php");
                    //Останавливаем скрипт
                    exit();
                }                
            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с именем</p>";
                //Возвращаем пользователя на страницу регистрации
                header("Location: book_1.php");
                //Останавливаем скрипт
                exit();
            }
			if(isset($_POST["message"])){
                //Обрезаем пробелы с начала и с конца строки
                $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

                //Проверяем переменную на пустоту
                if(empty($message)){
                     // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш логин</p>";
                    //Возвращаем пользователя на страницу регистрации
                     header("Location: book_1.php");
                    //Останавливаем скрипт
                    exit();
                }                
            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с логином</p>";
                //Возвращаем пользователя на страницу регистрации
                header("Location: book_1.php");
                //Останавливаем скрипт
                exit();
            }			
             // (4) Место для кода добавления пользователя в БД
            //Запрос на добавления пользователя в БД
			
            $result_query_insert = mysqli_query($link,"INSERT INTO `shoutbox` (`id_book`, `date_time`, `name`, `message`) VALUES ('".intval($id_book)."', NOW(), '".$name."', '".$message."')") or die("Ошибка " . mysqli_error($link));
            if(!$result_query_insert){
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на добавления пользователя в БД</p>";
                echo "<p class='mesage_error' > Ошибка запроса на добавления пользователя в БД</p>";
                //Возвращаем пользователя на страницу регистрации
                header("Location: book_1.php");
                //Останавливаем  скрипт
               # exit();
            }else{
                $_SESSION["success_messages"] = "<p class='success_message'>Регистрация прошла успешно!!! <br />Теперь Вы можете авторизоваться используя Ваш логин и пароль.</p>";
                //Отправляем пользователя на страницу авторизации
                #header("Location: form_auth.php");
            }
		$query1 = "SELECT * FROM `shoutbox` WHERE `id_book` = '$id_book'  ";
$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
if($result1)
{
	echo '<h2>Отзывы к товару</h2>';
		echo '<table align="center" width="100%" border="1">';
	$rows = mysqli_num_rows($result1); // количество полученных строк
    $columns = mysqli_num_fields($result1); // количество полученных полей
	for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result1);				
		echo "<tr>";
        echo '<td align="center">'.date("d.m.Y H:i", strtotime($row[2])).'</td>';
        echo '<td align="center">'.$row[3].'</td>';
        echo '<td align="center">'.$row[4].'</td>';        	
		echo "</tr>";				
	    }
		echo '</table >';
}	
      }
}
 
echo "Вернуться на <a href='index.php'>главную страницу</a>";
?>

<h2>Написать отзыв</h2>

<form method="post" action="book_1.php" class="form">

	<p><label for="ID_tovar">ID_товара:</label>
	<input type="text" id="name" name="id_book" ></p>
    <p><label for="name">Имя:</label> <input type="text" id="name" name="name" ></p>
	<p><label for="name">Отзыв:</label><input type="text" id="message" name="message" class="message" ></p>
    <p class="submit">
	<td colspan="2"><input type="submit" name="submit" value="Отправить"></td></p>
                    

</form>

<div id="shout"></div>
</div>
</body>
</html>	

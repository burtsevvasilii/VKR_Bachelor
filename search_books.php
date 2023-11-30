<!DOCTYPE html>
<html>
    <body>
<div id="header">
		<p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
             </p>
            <h2> Интернет-магазин "КнигоЛюб"</h2>
             <title>Список книг по определенному полю </title>
            </div>
             <div class="clear"></div>
<?php
$searchterm = trim ( $_POST['searchterm'] );
$searchtype = trim ( $_POST['searchtype'] );
if (!$searchterm)
    die ("Не все данные введены.<br>
    Пожалуйста, вернитесь назад и закончите ввод");
$searchterm = addslashes ($searchterm);

require_once 'connection.php'; // подключаем скрипт
 $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
$query ="SELECT `author`, `title`, `catname`, `izdatel`, `price`, `description`,`coun_exempl` ,`image_name` FROM `books`,`categories` WHERE `books`.`catid` = `categories`.`catid` AND `books`.`".$searchtype."` like '%".$searchterm."%' ORDER BY `books`.`id`  ";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
	echo '<h2>Книги на продажу по заданному поиску</h2>';
	echo '<table align="center" width="100%" border="1">';
	$rows = mysqli_num_rows($result); // количество полученных строк
    $columns = mysqli_num_fields($result); // количество полученных полей
	for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
		echo ' <td align="center"> <p class="fig"><img src="images/'.$row[7].'" width="100" height="200" alt=""></p>' ;
        ?>		
		<p>Автор: <?php  echo $row[0] ?></p>
		<p>Название: <?php  echo $row[1] ?></p>
		<p>Категория: <?php  echo $row[2] ?></p>
		<p>Издательство: <?php  echo $row[3] ?></p>
		<p>Цена: <?php  echo $row[4] ?></p>
		<p>Описание: <?php  echo $row[5] ?></p>
		<p>В наличии: <?php  echo $row[6] ?></p>
		<?php
		echo "</td>";					
			
	    }
echo "</table>";
if ( $rows == 0 ) echo "Ничего не можем предложить. Извините<br>"; 
}  
echo "Вернуться к <a href='books.php'>общему списку</a>";
?>
</body>
</html>
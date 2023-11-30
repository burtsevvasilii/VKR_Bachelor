<!DOCTYPE html>
<html>
  
<head>
        <title>Книги на продажу</title>
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
$query ="SELECT `id`, `author`, `title`, `catname`, `izdatel`, `price`, `description`,`coun_exempl` ,`image_name` FROM `books`,`categories` 
WHERE `books`.`catid` = `categories`.`catid` ORDER BY `books`.`id`  ";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
	echo '<table id = "table" align="center" width="100%" border="1">';
	$rows = mysqli_num_rows($result); // количество полученных строк
    $columns = mysqli_num_fields($result); // количество полученных полей
	for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
		echo ' <td align="center"> <p class="fig"><img src="/images/'.$row[8].'" width="100" height="200" alt=""></p>' ;
        ?>		
		<p class="fig" id = "product_author">Автор: <?php  echo $row[1] ?></p>
		<p class="fig" id = "product_name" align="center"><form method="POST" action="book_1.php"><input type = "submit" name="Название" value= "<?php  echo $row[2] ?>"></form></p>
		<p class="fig" id = "product_category">Категория: <?php  echo $row[3] ?></p>
		<p class="fig" id = "product_izd">Издательство: <?php  echo $row[4] ?></p>
		<p class="fig" id = "product_price">Цена: <?php  echo $row[5] ?> руб.</p>
		<p class="fig" id = "product_desc">Описание: <?php  echo $row[6] ?></p>
		<p class="fig" >В наличии: <?php  echo $row[7] ?></p>
		<div id="product_buy"><a href="/">Добавить в корзину</a></div>
				
		<?php
		echo "</td>";					
			
	    }
echo "</table>";
if ( $rows == 0 ) echo "Ничего не можем предложить. Извините<br>"; 
}  
echo "Вернуться на <a href='index.php'>главную страницу</a>";
?>
</div>
</body>
</html>	


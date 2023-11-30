<?php
require_once 'connection.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
$query ="SELECT `author`, `title`, `izdatel`, `price`, `image_name` FROM `books`,`categories` WHERE `books`.`catid` = `categories`.`catid` ORDER BY `books`.`id` DESC LIMIT 10";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
	echo '<table align="center" width="100%" border="1">';
	$rows = mysqli_num_rows($result); // количество полученных строк
    $columns = mysqli_num_fields($result); // количество полученных полей
	for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);		 
		echo ' <td align="center" > <div id="product_image"><img src="images/'.$row[4].'" width="100" height="200" alt=""></div>' ;
        ?>
		<div id="product_author">Автор: <?php  echo $row[0] ?></div>
		<div id="product_name">Название: <?php  echo $row[1] ?></div>
		<div id="product_desc">Издательство: <?php  echo $row[2] ?></div>
		<div id="price">Цена: <?php  echo $row[3] ?>  руб. </div>
		<div id="product_buy"><a href="/">Добавить в корзину</a></div>
		<?php
		echo "</td>";					
			
	    }
echo "</table>";
if ( $rows == 0 ) echo "Ничего не можем предложить. Извините<br>"; 
}  

?>

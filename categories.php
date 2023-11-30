<!DOCTYPE html>
<html>    
<div id="header">
		<p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
				<h3> Интернет-магазин "КнигоЛюб"</h3>
             </p>
            
             <title>Список категорий литературных произведений</title>
            </div>
             <div class="clear"></div>
<body> 
<link rel="stylesheet" type="text/css" href="./css/styles.css" />
<?php
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM `categories`";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
		echo '<h2>Категории</h2>';
		echo '<table id = "table" align="center" width="100%" border="1">';
	$rows = mysqli_num_rows($result); // количество полученных строк
    $columns = mysqli_num_fields($result); // количество полученных полей
	for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
		?>
            <p class="fig" >ID: <?php  echo $row[0] ?></p>
			<p class="fig" id = "product_category">Издательство: <?php  echo $row[1] ?></p>
        <?php
		echo "</tr>";
    }
echo "</table>";
if ( $rows == 0 ) echo "Ничего не можем предложить. Извините<br>"; 
}  
echo "Вернуться на <a href='index.php'>главную страницу</a>";
?>
</body>
</html>	

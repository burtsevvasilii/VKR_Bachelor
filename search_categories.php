<!DOCTYPE html>
<html>    
<div id="header">
		<p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
             </p>
            <h2> Интернет-магазин "КнигоЛюб"</h2>
             <title>Информация о выбранной категории литературных произведений по номеру </title>
            </div>
             <div class="clear"></div>
<body>
<?php
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
if(isset($_POST['id_cat'])) {
$id = $_POST['id_cat'];
}
$query ="SELECT * FROM `categories` WHERE catid = '$id'";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
		echo '<table align="center" width="50%" border="1">';
		echo '<tr>';
		echo '<td align="center" colspan="2">';
		echo "Категории";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
	$rows = mysqli_num_rows($result); // количество полученных строк
    $columns = mysqli_num_fields($result); // количество полученных полей
	    echo '<td align="center">';
		    echo "номер категории  ";
		    echo "</td>";
		echo '<td align="center">';
		    echo "название  ";
		    echo "</td>";
			echo "</tr>";	
     for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < $columns ; ++$j) 
			{
				echo '<td align="center">';
				echo $row[$j]  ;
				echo "</td>";				
			}
        echo "</tr>";
    }
echo "</table>";
  if ( $rows == 0 ) echo "Ничего не можем предложить. Извините<br>"; 
}  
echo "Вернуться на <a href='index.php'>главную страницу</a>";
?>
</body>
</html>	

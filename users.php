<!DOCTYPE html>
<html>    
<div id="header">
		<p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
             </p>
            <h2> Интернет-магазин "КнигоЛюб"</h2>
             <title>Список зарегистрированных пользователей</title>
            </div>
             <div class="clear"></div>
<body> 

<?php
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM `users`";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
		echo '<table align="center" width="50%" border="1">';
		echo '<tr>';
		echo '<td align="center" colspan="5">';
		echo "Зарегистрированные пользователи";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
	$rows = mysqli_num_rows($result); // количество полученных строк
    $columns = mysqli_num_fields($result); // количество полученных полей
	    echo '<td align="center">';
		    echo "ID";
		    echo "</td>";
		  echo '<td align="center">';
		    echo "логин";
		    echo "</td>";
			 echo '<td align="center">';
		    echo "пароль";
		    echo "</td>";
			echo '<td align="center">';
		    echo "e-vail";
		    echo "</td>";
		  echo '<td align="center">';
		    echo "статус";
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
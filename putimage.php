<?php
// Проверяем пришел ли файл
if( !empty( $_FILES['image']['name'] ) ) {
  // Проверяем, что при загрузке не произошло ошибок
  if ( $_FILES['image']['error'] == 0 ) {
    // Если файл загружен успешно, то проверяем - графический ли он
    if( substr($_FILES['image']['type'], 0, 5)=='image' ) {
      // Читаем содержимое файла
      $image = file_get_contents( $_FILES['image']['tmp_name'] );
      // Экранируем специальные символы в содержимом файла
      $image = mysql_escape_string( $image );
      // Формируем запрос на добавление файла в базу данных
      $query="INSERT INTO `images` VALUES(NULL, '".$image."')";
      // После чего остается только выполнить данный запрос к базе данных
        $res = mysql_query($query);
        $image = mysql_fetch_array($res);
         echo $image['content'];
    }
  }
}
?>
<html>
<body>
  <p class="fig">
  <img src="image.php?id=17" alt="" />
  </p>

</body>
</html>
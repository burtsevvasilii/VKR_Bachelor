<?php
    //Запускаем сессию
    #session_start();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Главная страница</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
    </head>
    <body>
		
        <div id="header">
		   <p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
				<h3>Интернет-магазин "КнигоЛюб"</h3>
             </p>
                        
            <div id="auth_block">
 
                <div id="link_register">
                    <a href="/form_register.php">Регистрация</a>
                </div>
 
                <div id="link_auth">
                    <a href="/form_auth.php">Авторизация</a>
                </div>
 
            </div>
             <div class="clear"></div>
        </div>
 
<div id="content">
    <h2> Добро пожаловать в Интернет-магазин "КнигоЛюб"</h2>
    <?php
	  require_once 'free_books.php'; 		
	?>
</div>
 
  </body>
</html>




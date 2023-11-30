<!DOCTYPE html>
<html>
<head>
        <title>Авторизация пользователя</title>
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
 
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
 
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
 
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }
 
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
             
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>
 <div id="content">
<?php
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>
 
 
    <div id="form_auth">
        
        <form action="auth.php" method="post" name="form_auth" class="form">
            <p><label for="login">Логин:</label> <input type="text" id="name" name="логин" class="message" required="required" /></p>
			<p><label for="login">Пароль:</label> <input type="password" id="name" name="password" class="message" placeholder="минимум 8 символов" required="required" /></p>
			<p class="submit"><td colspan="2"><input type="submit" name="btn_submit_auth" value="Войти"/></td></p>
              
        </form>
    </div>
 
<?php
    }else{
?>
 
    <div id="authorized">
        <h2>Вы уже авторизованы</h2>
    </div>
 <?php
    }
?>
 
 </div>
</body>
</html>	
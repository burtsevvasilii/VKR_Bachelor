<!DOCTYPE html>
<html>

        <head>
        <title>Регистрация пользователя</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
    </head>
    <body> 
        <div id="header">
		   <p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" ><h2>Интернет-магазин "КнигоЛюб"</h2> 
             </p>
                    
            
             <div class="clear"></div>
        </div>
 
        			 
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
        //Если в сессии существуют сообщения об ошибках, то выводим их
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
 
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }
 
        //Если в сессии существуют радостные сообщения, то выводим их
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
             
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>
 <div id="content">
<?php
    //Проверяем, если пользователь не авторизован, то выводим форму регистрации, 
    //иначе выводим сообщение о том, что он уже зарегистрирован
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>
        <div id="form_register">           
 
            <form action="register.php" method="post" class="form" name="form_register">
			<p><label for="fio">Фамилия Имя Отчество: </label><input type="text" id="фио" name="фио" class="message" required="required" ></p>
			<p><label for="login">Логин:</label> <input type="text" id="name" name="логин" class="message" required="required" ></p>
			<p><label for="status">Статус:</label><input type="text" id="status" name="status" class="message" required="required" ></p>
			<p><label for="email">Email: </label><input type="text" id="фио" name="email" class="message" required="required" ></p>
			<p><label for="login">Пароль:</label> <input type="password" id="name" name="password" class="message" placeholder="минимум 8 символов" required="required" ></p>
			<p><label for="status">Подтвердить пароль:</label><input type="password" id="status" name="tverd_password" class="message" placeholder="минимум 8 символов" required="required" ></p>
			<p class="submit"><td colspan="2"><input type="submit" name="btn_submit_register" value="Зарегистрироваться"></td></p>
                
            </form>
        </div>
<?php
    }else{
?>
        <div id="authorized">
            <h2>Вы уже зарегистрированы</h2>
        </div>
		<?php
	}
    
?>
</div>
	</body>
</html>	

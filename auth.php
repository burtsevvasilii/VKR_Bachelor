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
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
				<h3>Интернет-магазин "КнигоЛюб"</h3>
             </p>
                         
            
             <div class="clear"></div>
        </div>
		<div id="content">

<?php
    //Запускаем сессию
    #session_start();    
    //Добавляем файл подключения к БД
    require_once("connection.php");
    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
    $_SESSION["error_messages"] = '';
     
    //Объявляем ячейку для добавления успешных сообщений
    $_SESSION["success_messages"] = '';

    /*
    Проверяем была ли отправлена форма, то есть была ли нажата кнопка Войти. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
    */
    if(isset($_POST["btn_submit_auth"])){
     
        //(1) Место для следующего куска кода
                         
            //Обрезаем пробелы с начала и с конца строки
            $login = filter_var(trim($_POST['логин']), FILTER_SANITIZE_STRING);
            if(isset($_POST["логин"])){
             
                if(!empty($login)){                   
             
                    //Проверяем формат полученного почтового адреса с помощью регулярного выражения
                    $reg_login = "/^[a-z0-9]+[a-z]+/i";
             
                    //Если формат полученного почтового адреса не соответствует регулярному выражению
                    if( !preg_match($reg_login, $login)){
                        // Сохраняем в сессию сообщение об ошибке. 
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный логин</p>";
                         
                        //Возвращаем пользователя на страницу авторизации
                        header("Location: form_auth.php");
             
                        //Останавливаем скрипт
                        #exit();
                    }
                }else{
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Поле для ввода логина не должно быть пустой.</p>";
                     
                    //Возвращаем пользователя на страницу регистрации
                    header("Location: form_register.php");
             
                    //Останавливаем скрипт
                    #exit();
                }
                 
             
            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода логина</p>";
                 
                //Возвращаем пользователя на страницу авторизации
                header("Location: form_auth.php");
             
                //Останавливаем скрипт
                #exit();
            }
             //(2) Место для обработки пароля
            if(isset($_POST["password"])){
 
                //Обрезаем пробелы с начала и с конца строки
                $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);				
                if(empty($password)){
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Укажите Ваш пароль</p>";
                     
                    //Возвращаем пользователя на страницу регистрации
                   header("Location: form_auth.php");
             
                    //Останавливаем скрипт
                   # exit();
                }
                 
            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода пароля</p>";
                 
                //Возвращаем пользователя на страницу регистрации
                header("form_auth.php");
             
                //Останавливаем скрипт
                #exit();
            }

            //(4) Место для составления запроса к БД
            //Запрос в БД на выборке пользователя.
            $result_query_select = mysqli_query($link,"SELECT * FROM `users` WHERE login = '".$login."' AND password = '".$password."' ") or die("Ошибка " . mysqli_error($link));
             
            if(!$result_query_select){
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на выборке пользователя из БД</p>";
                 
                //Возвращаем пользователя на страницу регистрации
                header("Location: form_auth.php");
             
                //Останавливаем скрипт
                exit();
            }else{
             
                //Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
                if(mysqli_num_rows($result_query_select)== 1){
                     
                    // Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
                   $result_query_select2 = mysqli_query($link,"SELECT `status` FROM `users` WHERE login = '".$login."'  ") or die("Ошибка " . mysqli_error($link));
                   $row = mysqli_fetch_row($result_query_select2);				   
				   switch($row[0]){
                                     case 'заказчик':
									        echo "<p>Вы зашли как заказчик. Вы имеете следующие права:.</p>";
											echo "<p>Заполнить свои данные , перейдя на ссылку <a href='form_custom.php'>заполнить данные о покупателе-заказчике</a>.</p>";
											echo "<p>Просмотреть категории книг , перейдя на ссылку <a href='categories.php'>категорий</a>.</p>";
											echo "<p>Просмотреть имеющиеся товары , перейдя на ссылку <a href='books.php'>товары</a>.</p>";	
											echo "<p>Зайти на <a href='index.php'>главную страницу</a>.</p>";
                                            echo "<p><a href='index.php'>Выйти</a>.</p>";											
									                  break;
									 case 'сотрудник':
									        echo "<p>Вы зашли как сотрудник. Вы имеете следующие права:.</p>";			
                                            echo "<p>Просмотреть категории книг , перейдя на ссылку <a href='categories.php'>категорий</a>.</p>";											
											echo "<p>Просмотреть имеющиеся товары , перейдя на ссылку <a href='books.php'>товары</a>.</p>";	
											echo "<p>Добавить информацию о новом товаре , перейдя на ссылку <a href='insert_books.php'>добавить товар</a>.</p>";
											echo "<p><a href='index.php'>Выйти</a>.</p>";	
									                  break;
									 case 'администратор':
									        echo "<p>Вы зашли как администратор. Вы имеете следующие права:.</p>";		
                                            echo "<p>Просмотреть категории книг , перейдя на ссылку <a href='categories.php'>категорий</a>.</p>";											
											echo "<p>Просмотреть имеющиеся товары , перейдя на ссылку <a href='books.php'>товары</a>.</p>";	
											echo "<p>Просмотреть зарегистрированных пользователей, перейдя на ссылку <a href='users.php'>пользователи</a>.</p>";
											echo "<p>Просмотреть личные данные заказчиков в случае оформления заказов, перейдя на ссылку <a href='customers.php'>данные заказчиков</a>.</p>";
											echo "<p>Добавить новую категорию, перейдя на ссылку <a href='insert_category.php'>добавить категорию</a>.</p>";
											echo "<p><a href='index.php'>Выйти</a>.</p>";												
									                  break;
                                     
                   }		   
				   
                                 
                }else{
                     
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Неправильный логин и/или пароль</p>";
                     
                    //Возвращаем пользователя на страницу авторизации
                   header("Location: form_auth.php");
             
                    //Останавливаем скрипт
                    #exit();
                }
            }
        }
     
    else{
        echo "<p>Ошибка! Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href='index.php'> главную страницу </a>.</p>";
    }
	?>
	</div>
</body>
</html>	
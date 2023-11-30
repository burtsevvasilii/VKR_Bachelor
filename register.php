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
      //Добавляем файл подключения к БД
	require_once("connection.php");
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));    
     /*
        Проверяем была ли отправлена форма, то есть была ли нажата кнопка зарегистрироваться. Если да, то идём дальше, если нет, значит пользователь зашёл на эту страницу напрямую. В этом случае выводим ему сообщение об ошибке.
    */
    if(isset($_POST["btn_submit_register"])){
         // (1) Место для следующего куска кода 
                      // Проверяем если в глобальном массиве $_POST существуют данные отправленные из формы и заключаем переданные данные в обычные переменные.
            if(isset($_POST["фио"])){
                //Обрезаем пробелы с начала и с конца строки
                $fio = filter_var(trim($_POST['фио']), FILTER_SANITIZE_STRING);

                //Проверяем переменную на пустоту
                if(empty($fio)){
                     // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваши ФИО</p>";
                    //Возвращаем пользователя на страницу регистрации
                     header("Location: form_register.php");
                    //Останавливаем скрипт
                    exit();
                }                
            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с ФИО</p>";
                //Возвращаем пользователя на страницу регистрации
                header("Location: form_register.php");
                //Останавливаем скрипт
                exit();
            }
			if(isset($_POST["логин"])){
                //Обрезаем пробелы с начала и с конца строки
                $login = filter_var(trim($_POST['логин']), FILTER_SANITIZE_STRING);

                //Проверяем переменную на пустоту
                if(empty($login)){
                     // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш логин</p>";
                    //Возвращаем пользователя на страницу регистрации
                     header("Location: form_register.php");
                    //Останавливаем скрипт
                    exit();
                }                
            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с логином</p>";
                //Возвращаем пользователя на страницу регистрации
                header("Location: form_register.php");
                //Останавливаем скрипт
                exit();
            }  				
            if(isset($_POST["status"])){

                //Обрезаем пробелы с начала и с конца строки
                $status = filter_var(trim($_POST['status']), FILTER_SANITIZE_STRING);
                if(empty($status)){
                        // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш статус</p>";
                    //Возвращаем пользователя на страницу регистрации
                    header("Location: form_register.php");

                    //Останавливаем  скрипт
                    #exit();
                }                
            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле со  статусом</p>";
                
                //Возвращаем пользователя на страницу регистрации
                header("Location:form_register.php");

                //Останавливаем  скрипт
                #exit();
            }            
            if(isset($_POST["email"])){

                //Обрезаем пробелы с начала и с конца строки
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

                if(!empty($email)){                   

                    // (3) Место кода для проверки формата почтового адреса и его уникальности
                    //Проверяем формат полученного почтового адреса с помощью регулярного выражения
                    $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
                    //Если формат полученного почтового адреса не соответствует регулярному выражению
                    if( !preg_match($reg_email, $email)){
                        // Сохраняем в сессию сообщение об ошибке. 
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправельный email</p>";
                        echo "<p class='mesage_error' >Вы ввели неправельный email</p>";
                        //Возвращаем пользователя на страницу регистрации
                         header("Location:form_register.php");
                        //Останавливаем  скрипт
                       # exit();
                    }
                    //Проверяем нет ли уже такого адреса в БД.
                    $result_query = mysqli_query($link,"SELECT `email` FROM `users` WHERE email='".$email."'");                   
                    //Если кол-во полученных строк ровно единице, значит пользователь с таким почтовым адресом уже зарегистрирован
                    if(mysqli_num_rows($result_query) == 1 ){
                        //Если полученный результат не равен false
                        if(($row = mysqli_fetch_assoc($result_query)()) != false){                            
                                // Сохраняем в сессию сообщение об ошибке. 
                                $_SESSION["error_messages"] .= "<p class='mesage_error' >Пользователь с таким почтовым адресом уже зарегистрирован</p>";
                                echo "<p class='mesage_error' >Пользователь с таким почтовым адресом уже зарегистрирован</p>";
                                //Возвращаем пользователя на страницу регистрации
                                header("Location: form_register.php");                            
                        }else{
                            // Сохраняем в сессию сообщение об ошибке. 
                            $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка в запросе к БД</p>";
                            
                            //Возвращаем пользователя на страницу регистрации
                              header("Location: form_register.php");
                        }
                        
                        #exit();
                    }                   
                }else{
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш email</p>";
                    
                    //Возвращаем пользователя на страницу регистрации
                    header("Location: form_register.php");

                    //Останавливаем  скрипт
                    #exit();
                }

            } else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода Email</p>";
                
                //Возвращаем пользователя на страницу регистрации
                 header("Location: form_register.php");

                //Останавливаем  скрипт
                #exit();
            }

            
            if(isset($_POST["password"])){

                //Обрезаем пробелы с начала и с конца строки
                $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);				
                if(empty($password)){                 
                 
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш пароль</p>";
                    
                    //Возвращаем пользователя на страницу регистрации
                     header("Location: form_register.php");

                    //Останавливаем  скрипт
                    #exit();
                }

            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода пароля</p>";
                
                //Возвращаем пользователя на страницу регистрации
                header("Location: form_register.php");

                //Останавливаем  скрипт
                #exit();
            }
			if(isset($_POST["tverd_password"])){

                //Обрезаем пробелы с начала и с конца строки
                $password2 = filter_var(trim($_POST['tverd_password']), FILTER_SANITIZE_STRING);				
                if(empty($password2)){                 
                 
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Подтвердите Ваш пароль</p>";
                    
                    //Возвращаем пользователя на страницу регистрации
                     header("Location: form_register.php");

                    //Останавливаем  скрипт
                    #exit();
                }
				if(strnatcmp($password,$password2)!=0){                 
                 
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Пароли не совпадают</p>";
                    
                    //Возвращаем пользователя на страницу регистрации
                     header("Location: form_register.php");

                    //Останавливаем  скрипт
                    #exit();
                }

            }else{
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для подтверждения пароля </p>";
                
                //Возвращаем пользователя на страницу регистрации
                header("Location: form_register.php");

                //Останавливаем  скрипт
                #exit();
            }
            // (4) Место для кода добавления пользователя в БД
            //Запрос на добавления пользователя в БД
			
            $result_query_insert = mysqli_query($link,"INSERT INTO `users` (`login`, `password`, `mail`, `status`,`fio`) VALUES ('".$login."', '".$password."', '".$email."', '".$status."', '".$fio."')") or die("Ошибка " . mysqli_error($link));
            if(!$result_query_insert){
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на добавления пользователя в БД</p>";
                echo "<p class='mesage_error' > Ошибка запроса на добавления пользователя в БД</p>";
                //Возвращаем пользователя на страницу регистрации
                header("Location: form_register.php");
                echo "<p>Ошибка! Вы не зарегистрированны, поэтому нет данных для обработки. Вы можете перейти на <a href='index.php'> главную страницу </a>.</p>";
                //Останавливаем  скрипт
               # exit();
            }else{
                $_SESSION["success_messages"] = "<p class='success_message'>Регистрация прошла успешно!!! <br />Теперь Вы можете авторизоваться используя Ваш логин и пароль.</p>";
               echo "<p class='success_message'>Вы зарегистрированы <br />Теперь Вы можете <a href='form_auth.php'>авторизоваться используя Ваш логин и пароль.</p>";
			   echo "<p class='success_message'>Вы можете перейти на <a href='index.php'> главную страницу </a>.</p>";			     
                //Отправляем пользователя на страницу авторизации
                #header("Location: form_auth.php");
            }       
      }else{
        echo  "<p>Ошибка! Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href='index.php'> главную страницу </a>.</p>";
    }
?>
</div>
</body>
</html>	

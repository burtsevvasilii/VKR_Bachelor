<?php
    if (isset($_POST['GO'])) //если была нажата кнопка регистрации, проверим данные на корректность и, если данные введены и введены правильно, добавим запись с новым пользователем в БД
	{
		$correct = registrationCorrect(); //записываем в переменную результат работы функции registrationCorrect(), которая возвращает true, если введённые данные верны и false в противном случае
		if ($correct) //если данные верны, запишем их в базу данных
		{
			$login = htmlspecialchars($_POST['login']);
			$password = $_POST['password'];
			$mail = htmlspecialchars($_POST['mail']);
			$salt = mt_rand(100, 999);
			$tm = time();
			$password = md5(md5($password).$salt);
			$result =mysqli_query("INSERT INTO users (login,password,salt,mail_reg,mail,last_act,reg_date) VALUES ('".$login."','".$password."','".$salt."','".$mail."','".$mail."','".$tm."','".$tm."')") or die("Ошибка " . mysqli_error($link));
			if ($result) //пишем данные в БД и авторизовываем пользователя
			{
				setcookie ("login", $login, time() + 50000, '/');
				setcookie ("password", md5($login.$password), time() + 50000, '/');
				$rez = mysqli_query("SELECT * FROM users WHERE login=".$login);
				$row = mysqli_fetch_assoc($rez);
				$_SESSION['id'] = $row['id'];
				$regged = true;
				include_once("reg_user.php"); //подключаем шаблон
				echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
    		}
			include_once("reg_user.php"); //подключаем шаблон в случае некорректности данных
			echo "Ошибка! Вы не зарегистрированы.";
		}
		else
		{
			include_once("reg_user.php"); //подключаем шаблон в случае некорректности данных			
		}
	}
    ?>
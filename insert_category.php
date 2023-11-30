<!DOCTYPE html>
<html>    
<div id="header">
		<p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
             </p>
            <h2> Интернет-магазин "КнигоЛюб"</h2>
             <title>Новая категория литературного произведения</title>
            </div>
             <div class="clear"></div>
<body> 
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

    <div id="form_cust">
        <h2>Форма новой категории</h2>
        <form action="save_category.php" method="post" name="form_cust">
            <table>
          
                <tbody>
                 <tr>
				     <td> Категория: </td>
                    <td>
                        <input type="text" name="category" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit_custom" value="Сохранить">
                    </td>
                </tr>
            </tbody></table>
        </form>
    </div>
 
</body>
</html>	
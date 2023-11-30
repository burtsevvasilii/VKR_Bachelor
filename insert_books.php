<!DOCTYPE html>
<html>    
<div id="header">
		<p class="fig">
                <img src="images/Book-O-Rama.gif" width="120" height="120" alt="" />
             </p>
            <h2> Интернет-магазин "КнигоЛюб"</h2>
             <title>Поставка нового товара</title>
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
        <h2>Форма нового товара</h2>
        <form action="save_book.php" method="post" name="form_cust">
            <table>
          
                <tbody>
                 <tr>
				     <td> Автор: </td>
                    <td>
                        <input type="text" name="author" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>
                <tr>
                    <td> Название: </td>
                    <td>
                        <input type="text" name="title"  required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>
                 <tr>
				     <td> Номер сатегории: </td>
                    <td>
                        <input type="number" name="num_cat" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>
				 <tr>
				     <td> Издательство: </td>
                    <td>
                        <input type="text" name="izdatel" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>
				<tr>
				     <td> Цена: </td>
                    <td>
                        <input type="number" name="price" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>
				 <tr>
				     <td> Описание: </td>
                    <td>
                        <input type="text" name="description" size="100" maxlength="100" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>
				  </tr>
				 <tr>
				     <td> Изображение: </td>
                    <td>
                        <input type="text" name="name_image" size="100" maxlength="100" required="required"><br>
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
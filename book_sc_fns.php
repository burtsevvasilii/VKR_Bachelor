<?php
include 'output_fns.php';
function do_html_header($title = '')
{
  // Выводит HTML-заголовок
  
  // Объявить переменные сеанса
  if(!$_SESSION['items']) $_SESSION['items'] = '0';
  if(!$_SESSION['total_price']) $_SESSION['total_price'] = '0.00';
?>
  <html>
  <head>
    <title><?php echo $title; ?></title>
    <style>
      h2 { font-family: Arial, Helvetica, sans-serif; font-size: 22px; 
           color = red; margin = 6px }
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #FF0000; width=70%; text-align=center}
      a { color: #000000 }
    </style>
  </head>
  <body>
  <table width='100%' border=0 cellspacing = 0 bgcolor='#cccccc'>
  <tr>
  <td rowspan = 2>
  <a href = 'index.php'><img src='images/Book-O-Rama.gif' alt='Магазин
   КНИГОЛЮБ' border=0
       align='left' valign='bottom' height = 300 width = 325></a>
  </td>
  <td align = 'right' valign = 'bottom'>
  <?php if(isset($_SESSION['admin_user']))
       echo '&nbsp;';
     else
       echo 'Всего книг = '.$_SESSION['items']; 
  ?>
  </td>
  <td align = 'right' rowspan = 2 width = 135>
  <?php if(isset($_SESSION['admin_user']))
       display_button('logout.php', 'log-out', 'Выход');
     else
       display_button('show_cart.php', 'view-cart', 'Показать тележку');
  ?>
  </tr>
  <tr>
  <td align = right valign = top>
  <?php if(isset($_SESSION['admin_user']))
       echo '&nbsp;';
     else
       echo 'Общая сумма = $'.number_format($_SESSION['total_price'],2); 
  ?>
  </td>
  </tr>
  </table>
<?php
  #if($title)
    #do_html_heading($title);
}
function do_html_footer()
{
  // Выводит завершающие HTML-дескрипторы
?>
  </body>
  </html>
<?php
 // Далее идет продолжение кода из библиотеки функций 
}


?>
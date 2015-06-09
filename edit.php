<?php
session_start();
if(!($_SESSION['login']==pit && $_SESSION['passwd']==123))  Header:("Location: index.php");
$conn=mysql_connect("localhost", "user","123") or die ("Невозможно установить соединение: ".mysql_error());  
mysql_query("set names 'cp1251',$conn");
mysql_select_db("book");
$table_name="mybooks"; $idd=$_GET["idd"];
$sql="SELECT id, title, author, date, cover, download, permission FROM $table_name WHERE id=$idd";
$q=mysql_query($sql,$conn) or die(); 
$title=mysql_result($q,0,1);
$author=mysql_result($q,0,2);
$date=mysql_result($q,0,3);
?>
<a href="home.php" > на главную </a>

<?php
echo "<form enctype =\"multipart/form-data\" action =\"parse2.php\" method=\"post\">           
                  Название книги: <input type=\"text\" name=\"title\" required=\"required\"  value= \"$title\" /> <br><br>
                  Автор:          <input type=\"text\" name=\"author\" required=\"required\" value= \"$author\" />  <br> <br>
                  Дата прочтения:<input type=\"date\" name= \"date\" required=\"required\" value=$date /><br> <br>			  
				  Обложка: <input type=\"file\" name=\"userfile[]\" /><br> <br>
				  файл с книгой:<input type=\"file\" name=\"userfile[]\" /><br> <br>
				  Разрешить скачивание: <input type=checkbox name= \"permission\"><br>
				  <input type=\"hidden\" name=\"idd\" value=$idd>
				                    <input type=submit name=add value=\"Редактировать\"> 
				   </form>";			   
?>
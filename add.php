<?php
session_start();
if(!($_SESSION['login']==pit && $_SESSION['passwd']==123))  Header:("Location: index.php");
?>

<a href="home.php" > на главную </a>

<form enctype ="multipart/form-data" action ="parse.php" method="post">           
                  Название книги: <input type="text" name="title" required="required" /> <br><br>
                  Автор: <input type="text" name="author" required="required" />  <br> <br>
                  Дата прочтения:<input type="date" name= "date" required="required" /><br> <br>			  
				  Обложка: <input type="file" name= "userfile[]" required="required" /><br> <br>

				  файл с книгой:<input type="file" name="userfile[]" required="required"/><br> <br>
				  Разрешить скачивание: <input type=checkbox name= "permission"><br>
				                    <input type=submit name=add value="Добавить"> 
				   </form>
				   
				   
<?php
session_start();
if(!($_SESSION['login']==pit && $_SESSION['passwd']==123))  Header:("Location: index.php");
?>

<a href="home.php" > �� ������� </a>

<form enctype ="multipart/form-data" action ="parse.php" method="post">           
                  �������� �����: <input type="text" name="title" required="required" /> <br><br>
                  �����: <input type="text" name="author" required="required" />  <br> <br>
                  ���� ���������:<input type="date" name= "date" required="required" /><br> <br>			  
				  �������: <input type="file" name= "userfile[]" required="required" /><br> <br>

				  ���� � ������:<input type="file" name="userfile[]" required="required"/><br> <br>
				  ��������� ����������: <input type=checkbox name= "permission"><br>
				                    <input type=submit name=add value="��������"> 
				   </form>
				   
				   
<?php
session_start();
if(!($_SESSION['login']==pit && $_SESSION['passwd']==123))  Header:("Location: index.php");
$conn=mysql_connect("localhost", "user","123") or die ("Невозможно установить соединение: ".mysql_error()); 
mysql_query("SET NAMES 'cp1251'");
mysql_query("SET CHARACTER SET 'cp1251'");
mysql_select_db("book"); 
 $title=$_POST["title"];  
 $author=$_POST["author"];
 $date=$_POST["date"]; 
 if ($_FILES['userfile']['size'][0]< 1024*5*1024 &&  $_FILES['userfile']['size'][1]<1024*5*1024) 
       {
         $uploaddir = "z:/home/test1.ru/www/";
         $destination=$uploaddir .$_FILES['userfile']['name'][0];  $cover= $_FILES['userfile']['name'][0];
         move_uploaded_file($_FILES['userfile']['tmp_name'][0], $destination);
         $destination=$uploaddir .$_FILES['userfile']['name'][1];  $download= $_FILES['userfile']['name'][1];
         //print_r ($_FILES);
         move_uploaded_file($_FILES['userfile']['tmp_name'][1], $destination);
         if($_POST['permission']=='on'){$permission="1";} else{$permission="0";} 
         $sql="INSERT INTO book.mybooks (id, title, author, date, cover, download, permission) 
                            VALUES (NULL, '$title', '$author', '$date', '$cover', '$download', '$permission')";
         mysql_query($sql,$conn) or die(); } 
else echo "size of file is big";

?>
<a href="add.php" title="create new book"> ADD MORE</a> <p align="center"> <a href="home.php" > BACK</a> </p>

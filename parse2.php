<?php
session_start();
if(!($_SESSION['login']==pit && $_SESSION['passwd']==123))  Header:("Location: index.php");
$conn=mysql_connect("localhost", "user","123") or die ("Невозможно установить соединение: ".mysql_error()); 
mysql_query("set names 'cp1251',$conn");
mysql_select_db("book"); 
 $title= $_POST["title"];  
 $author=$_POST["author"]; 
 $date=$_POST["date"]; 
 $id=$_POST["idd"]; 
 
 if ($_FILES['userfile']['size'][0]< 1024*5*1024 &&  $_FILES['userfile']['size'][1]<1024*5*1024) 
       { 
         $uploaddir = "z:/home/test1.ru/www/";
         $destination=$uploaddir .$_FILES['userfile']['name'][0];  $cover= $_FILES['userfile']['name'][0];
         move_uploaded_file($_FILES['userfile']['tmp_name'][0], $destination);
         $destination=$uploaddir .$_FILES['userfile']['name'][1];  $download= $_FILES['userfile']['name'][1];
         move_uploaded_file($_FILES['userfile']['tmp_name'][1], $destination);
         if($_POST['permission']=='on'){$permission="1";} else{$permission="0";}
         $sql= "UPDATE book.mybooks SET title = '$title',  author = '$author',   date = '$date', cover= '$cover', download ='$download', permission = '$permission' WHERE mybooks.id =$id";        
		 mysql_query($sql,$conn) or die(); 
	    if(mysql_query) {echo "changes have been made";}} 
else echo "size of file is big";  
?>
<a href="home.php"> BACK</a>
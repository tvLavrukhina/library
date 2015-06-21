<?php
session_start();
include("connection.php");

function FileSizeOk()
{
	if ($_FILES["userfile"]["size"][0]< 1024*5*1024 &&  $_FILES["userfile"]["size"][1]<1024*5*1024) {
	    return true;  
	} else {
		echo "Размер загружаемых файлов превышает допустимые <br>";
	}
}

function FileImage()
{   
	if($_FILES["userfile"]["type"][0] != "image/jpeg" && $_FILES["userfile"]["type"][0] != "image/png" && $_FILES["userfile"]["type"][0] !="") {
             echo "Sorry, we only allow uploading JPG or PNG images";
        }  else {
		    return true;
	    }
}

 echo "<a href=\"index.php\" > на главную </a>";

  if(!isset($_POST["edit"])) {
	    $table_name="mybooks";
	    $idd=mysql_real_escape_string((int)$_GET["idd"]); 
	    $sql = $conn->prepare("SELECT id, title, author, date, cover, download, permission FROM $table_name WHERE id=$idd");  
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
	    while ($row = $sql->fetch()){
            $title = $row["title"];
            $author = $row["author"];
            $date = $row["date"];
		}    
       echo "<form enctype =\"multipart/form-data\" action =\"edit.php\" method=\"post\">           
                  Название книги: <input type=\"text\" name=\"title\" required=\"required\"  value= \"$title\" /> <br><br>
                  Автор:          <input type=\"text\" name=\"author\" required=\"required\" value= \"$author\" />  <br> <br>
                  Дата прочтения:<input type=\"date\" name= \"date\" required=\"required\" value=$date /><br> <br>			  
				  Обложка: <input type=\"file\" name=\"userfile[]\" /><br> <br>
				  файл с книгой:<input type=\"file\" name=\"userfile[]\" /><br> <br>
				  Разрешить скачивание: <input type=checkbox name= \"permission\"><br>
				  <input type=\"hidden\" name=\"idd\" value=$idd>
				  <input type=submit name=edit value=\"Редактировать\"> 
				   </form>"; 
	}   else { 
	        $idd = mysql_real_escape_string((int)$_POST["idd"]);
            $title = mysql_real_escape_string($_POST["title"]);  
            $author = mysql_real_escape_string($_POST["author"]);
            $date = mysql_real_escape_string($_POST["date"]); 
			$login = mysql_real_escape_string($_SESSION["login"]);  
            if (FileSizeOk() && FileImage()) {
	            $uploaddir = $_SERVER["DOCUMENT_ROOT"];
                $destination_cover = $uploaddir ."/img_".$login."/".date(U).$_FILES["userfile"]["name"][0];  
				$cover = date(U).$_FILES["userfile"]["name"][0];              
				move_uploaded_file($_FILES["userfile"]["tmp_name"][0], $destination_cover);
				if ($_FILES["userfile"]["name"][1]!=""){
                    $destination_book = $uploaddir ."/book_".$login."/".date(U).$_FILES["userfile"]["name"][1];   
				    $download = date(U).$_FILES["userfile"]["name"][1];
                    move_uploaded_file($_FILES["userfile"]["tmp_name"][1], $destination_book);
				}
                if($_POST["permission"]=="on" && $_FILES["userfile"]["name"][1]!=""){
					$permission="1";
				}   else {
				       	$permission="0";
			     	} 
				if (preg_match("/[0-9A-Za-z]/",$login)) {
					$sql = $conn->prepare("UPDATE book.mybooks SET title = \"$title\",  author = \"$author\", date = \"$date\", 
				                          cover= \"$cover\", download =\"$download\", permission = \"$permission\" WHERE id=$idd");  
                    $sql->execute();
			        $sql->setFetchMode(PDO::FETCH_ASSOC);
    			}   else {echo "логин не соответствует";
				    }
            }
	    }


?>

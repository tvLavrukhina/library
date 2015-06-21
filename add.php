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
	if($_FILES["userfile"]["type"][0] != "image/jpeg" && $_FILES["userfile"]["type"][0] != "image/png") {
             echo "Sorry, we only allow uploading JPG or PNG images";
        }  else {
		    return true;
	    }
}

 echo "<a href=\"index.php\" > на главную </a>";
    if(!isset($_POST["add"])) {
        echo  "<form enctype =\"multipart/form-data\" action =\"add.php\" method=\"post\">           
                  Название книги: <input type=\"text\" name=\"title\" required=\"required\" /> <br><br>
                  Автор: <input type=\"text\" name=\"author\" required=\"required\" />  <br> <br>
                  Дата прочтения:<input type=\"date\" name= \"date\" required=\"required\" /><br> <br>			  
				  Обложка: <input type=\"file\" name= \"userfile[]\" required=\"required\" /><br> <br>

				  файл с книгой:<input type=\"file\" name=\"userfile[]\" required=\"required\"/><br> <br>
				  Разрешить скачивание: <input type=checkbox name= \"permission\"><br>
				                    <input type=submit name=add value=\"Добавить\"> 
				   </form>";
	}	else {
            $title = mysql_real_escape_string($_POST["title"]);  
            $author = mysql_real_escape_string($_POST["author"]);
            $date = mysql_real_escape_string($_POST["date"]); 
			$login = mysql_real_escape_string($_SESSION["login"]);  
            if (FileSizeOk() && FileImage()) {
	            $uploaddir = $_SERVER["DOCUMENT_ROOT"];
                $destination_cover = $uploaddir ."/img_".$login."/".date(U).$_FILES["userfile"]["name"][0];  
				$cover = date(U).$_FILES["userfile"]["name"][0];              
				move_uploaded_file($_FILES["userfile"]["tmp_name"][0], $destination_cover);
                $destination_book = $uploaddir ."/book_".$login."/".date(U).$_FILES["userfile"]["name"][1];   
				$download = date(U).$_FILES["userfile"]["name"][1];
                move_uploaded_file($_FILES["userfile"]["tmp_name"][1], $destination_book);
                if($_POST["permission"]=="on"){
					$permission="1";
				} else {
					$permission="0";
				} 
				if (preg_match("/[0-9A-Za-z]/",$login)) {
				$sql = $conn->prepare("INSERT INTO book.mybooks (id, title, author, date, cover, download, permission, login) 
                                                VALUES (NULL, \"$title\", \"$author\", \"$date\", \"$cover\", \"$download\", \"$permission\", \"$login\")");  
                $sql->execute();
			    $sql->setFetchMode(PDO::FETCH_ASSOC);
  				} else {echo "логин не соответствует";
				  }
				unset($_POST["add"]);
				echo "<a href=\"add.php\" > <br> добавить еще </a>";  
			}
	}
?>

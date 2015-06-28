<?php
session_start();
include("connection.php");
include("upload.php");

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
    }  else {
        $title = $_POST["title"];  
        $author = $_POST["author"];
        $date = $_POST["date"]; 
        $login = $_SESSION["login"]; 
        $uploaddir = $_SERVER["DOCUMENT_ROOT"];
        $upload_cover = FileUpload($file_content = "Файл с обложкой:  ", $uploaddir, $login, $i=0);  
        $upload_file = FileUpload($file_content = "Файл с книгой:  ", $uploaddir, $login, $i=1);			
        if ($upload_cover && $upload_file) {
            $cover = date(U).$_FILES["userfile"]["name"][0];
            $download = date(U).$_FILES["userfile"]["name"][1];
            if ($_POST["permission"]=="on") {
                $permission="1"; 
            } else {
                $permission="0";
            } 
            if (!preg_match("/[^0-9A-Za-z]/",$login)) {
                $sql = $conn->prepare("INSERT INTO book.mybooks (id, title, author, date, cover, download, permission, login) 
                                                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");  
                $sql->execute(array($title, $author, $date, $cover, $download, $permission, $login));
                $sql->setFetchMode(PDO::FETCH_ASSOC);
            } else {
                echo "логин не соответствует";
            }
            unset($_POST["add"]);
            echo "<a href=\"add.php\" > <br> добавить еще </a>";  
        } else {
            unset($_POST["add"]);
            echo "<a href=\"add.php\" > <br> еще раз </a>"; 
        }
    }
?>

<?php
session_start();
include("connection.php");
include("upload.php");
 
echo "<a href=\"index.php\" > на главную </a>";
if (!isset($_POST["edit"])) {
    $table_name="mybooks";
    $idd=(int)$_GET["idd"]; 
    $sql = $conn->prepare("SELECT id, title, author, date, cover, download, permission FROM $table_name WHERE id= ?");  
    $sql->execute(array($idd));
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $sql->fetch()) {
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
} else { 
    $idd = (int)$_POST["idd"];
    $title = $_POST["title"];  
    $author = $_POST["author"];
    $date = $_POST["date"]; 
    $login = $_SESSION["login"];
    $uploaddir = $_SERVER["DOCUMENT_ROOT"];
    if ($_FILES["userfile"]["name"][0]!="") {
        $upload_cover = FileUpload($file_content = "Файл с обложкой:  ", $uploaddir, $login, $i=0);
        $cover = date(U).$_FILES["userfile"]["name"][0];
    } else {
        $upload_cover = true;
    }
    if ($_FILES["userfile"]["name"][1]!="") {
        $upload_file = FileUpload($file_content = "Файл с книгой:  ", $uploaddir, $login, $i=1);
        $download = date(U).$_FILES["userfile"]["name"][1];
    } else {
        $upload_file = true;
    }
    if ($upload_cover && $upload_file) {
        if ($_POST["permission"]=="on" && $_FILES["userfile"]["name"][1]!="") {
            $permission="1";
        } else {
            $permission="0";
        } 
        if (!preg_match("/[^0-9A-Za-z]/",$login)) {
            $sql = $conn->prepare("UPDATE book.mybooks SET title = ?,  author = ?, date = ?, 
                            cover= ?, download = ?, permission = ? WHERE id = ?");  
            $sql->execute(array($title, $author, $date, $cover, $download, $permission, $idd));
            $sql->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            echo "логин не соответствует";
        }
    }
}
?>

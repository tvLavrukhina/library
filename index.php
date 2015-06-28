<?php
session_start();
include("connection.php");
const FIELDS_NUMBER= 6;
const FIELD_PERMISSION= 6;
const FIELD_ID= 0;

function CheckAuthorization()
{
    global $conn;
    if(isset($_GET["go"])) {
        $login = $_GET["login"];
        $password = $_GET["passwd"];
        $zpassword=md5($password);
        if (!preg_match("/[^0-9A-Za-z]/",$login)) {
            $sql = $conn->prepare("SELECT password FROM book.login WHERE login= ? ");  
            $sql->execute(array($login));
            $sql->setFetchMode(PDO::FETCH_ASSOC);  	  
            while ($row = $sql->fetch()) {
                $truepassword=$row["password"];
            }    
            if ($truepassword==$zpassword) { 
                $_SESSION["login"] = $_GET["login"];
                $_SESSION["passwd"] = $_GET["passwd"];
                return true;
            } else {
                echo "Ошибка ввода имени или пароля \n";
            }
        } else {
            echo "логин не соответствует зарегистрированным";
        }
    }
}
?>        

<html>
 <head> 
  <title> Личная библиотека книг </title> 
   <style type="text/css">
    table {
         border-style: none; 
         width: 90%; 
    }
    table td { 
        background-color: #005533; 
    }
    table td font{
        color: #FFFFFF;
    }
    table.A {
        background-color: #FFFFFF;
        border-style: solid;	
        width: 90%;
    }
    table.A th {
        background-color: #C2E3B6;
        align: center;
        border: solid;
    }
    table.A td font{
        size: 15;
        
    }
  </style>
 </head>
 <body>
  <h2> Личная библиотека книг </h2>

<?php
    $table_name="mybooks";   
    $names = array("id", "title", "author", "date", "cover", "download", "permission", "login");
    if (!isset($_GET["go"]) or !CheckAuthorization()) {
?>           
        Авторизация 
        <form action="index.php"> Login: <input type=text name=login>
                               Password: <input type=password name=passwd>
                                         <input type=submit name=go value=Go> </form>
<?php       
        $sql = $conn->prepare("SELECT * FROM $table_name ORDER BY date DESC");  
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);  
        echo "<TABLE> <tr> <TD>  <font> <b> $table_name</b> </font> </td> </tr> </TABLE>";
        echo "<table CLASS=A <tr>";
        for ($i=1;$i<FIELDS_NUMBER;$i++) {       //шапка таблицы  
            $val=$names[$i]; 
            echo "<th CLASS =A><font>$val</font></th>";
        }
        echo "</tr>"; 
        while ($row = $sql->fetch()) {
            echo "<tr>";
            for ($k=1; $k<FIELDS_NUMBER;$k++) {
                $val=$names[$k];
                $value = $row[$val];     
                if ($val=="cover"){
                    $str="<td CLASS=A> <font size=2>&nbsp;"; 
                    $str.="<img src= \"http://test1.ru/img_pit/$value";  
                    $str.= "\" width=100 height=150 />"; 
                    $str.="</font></td>"; 
                    echo $str;
                } else {  
                    if ($val=="download") {
                        if ($row["permission"]=="1") {
                            $str="<td> <font size=2>&nbsp; ";
                            $str.="<a href=\"http://test1.ru/book_pit/$value"; 
                            $str.=" \"download> download </a> ";
                            $str.="</font></td>" ;
                        } else {
                            $str="<td> <font size=2>&nbsp; </font></td>";
                        };
                        echo $str;
                    } else { 
                        echo "<td> <font size=2>&nbsp; $value </font></td>";
                    }
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    }  else {  
        $str = "<a href=\"add.php\" title= 'создать новую книгу'> Добавить книгу</a> 
                    <p align=\"center\"> <a href= \"index.php\" > Выход</a> </p>"; 
        echo $str;
        $login = $_GET["login"];
        if (preg_match("/[0-9A-Za-z]/",$login)) {
            $sql = $conn->prepare("SELECT * FROM $table_name WHERE login = ? ORDER BY date DESC");  
            $sql->execute(array($login));
            $sql->setFetchMode(PDO::FETCH_ASSOC); 
        }
        echo "<TABLE><tr><TD> <font> <b> $table_name</b></font></td></tr></TABLE>";
        echo "<table>";
        echo "<tr>";
        for ($i=1;$i<FIELDS_NUMBER;$i++) {
            $val=$names[$i]; echo "<th><font>$val</font></th>";
        }  //строка с названиями
        echo "<th><font> edit </font></th> </tr>";
        while ($row = $sql->fetch()){
            echo "<tr>";
            for ($k=1; $k<FIELDS_NUMBER;$k++) {	
                $val=$names[($k)];
                $value = $row[$val];  
                if ($val=="cover") {
                    $str="<td> <font size=2>&nbsp;"; 
                    $str.="<img src= \"http://test1.ru/img_$login/$value";  
                    $str.= " \" width=100 height=150 />"; 
                    $str.="</font></td>"; echo $str;
                } else {
                    if ($val=="download") {
                        if ($row["permission"]=="1") {
                            $str="<td> <font size=2>&nbsp; ";
                            $str.="<a href=\"http://test1.ru/book_$login/$value"; 
                            $str.=" \" download> download </a> ";
                            $str.="</font></td>" ;
                        }  else {
                            $str="<td> <font size=2>&nbsp;  </font></td>";
                        };
                        echo $str;
                    } else {
                        echo "<td> <font size=2>&nbsp; $value </font></td>";
                    }
                }
            }
            $id=$row["id"]; echo "<td> <font size=2>&nbsp; <a href= \"edit.php?idd=$id\"  > редактировать </a> </font></td>";  
            echo "</tr>";
        }
        echo "</table>";
    }
?>
</body></html>
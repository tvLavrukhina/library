<?php
try {  
  $conn = new PDO("mysql:host=localhost; dbname=book", "user", "123");  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->exec("set names cp1251");
}  
catch(PDOException $e) {  
    echo $e->getMessage();  
}                
?>



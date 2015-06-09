<?php
session_start();
if(!($_SESSION['login']==pit && $_SESSION['passwd']==123)) Header("Location: index.php");
$conn=mysql_connect("localhost", "user","123") or die ("Невозможно установить соединение: ".mysql_error());  
mysql_query("set names 'cp1251',$conn");
mysql_select_db("book");
?>

<html> <head><title> Личная библиотека книг </title> </head> 
<body>
<h2> ЛИЧНАЯ БИБЛИОТЕКА КНИГ</h2>

<a href="add.php" title="создать новую книгу"> Добавить книгу</a> <p align="center"> <a href="index.php" > Выход</a> </p>

</body > </ html>

<?php 
$table_name="mybooks";
  $list_f=mysql_list_fields("book", "mybooks",$conn); //список полей
  $n=mysql_num_fields($list_f);                       //число полей
   for($j=1; $j<$n;$j++)
   {$names[]=mysql_field_name($list_f, $j);}          // массив с именами полей
$sql="SELECT id, title, author, date, cover, download, permission FROM $table_name ORDER BY date DESC";
$q=mysql_query($sql,$conn) or die(); 
$m=mysql_num_rows($q);                            // число строк в таблице
echo "&nbsp; <TABLE BORDER=0 CELLSPACING=0 width=90% align=centre><tr><TD BGCOLOR='#FF00FF' align=centre> <font color='#FFFFFF'> <b> $table_name</b></font></td></tr></TABLE>";
echo "<table cellspacing=0 cellspacing=1 border=1 width=90% align=centre";
echo "<tr>";
for ($i=0;$i<($n-2);$i++){ $val=$names[$i]; echo "<th ALIGN=CENTER BGCOLOR='#C2E3B6'><font size=2>$val</font></th>";}  //строка с названиями
 echo "<th ALIGN=CENTER BGCOLOR='#C2E3B6'><font size=2> edit </font></th>";
echo "</tr>"; 

for ($i=0;$i<$m;$i++){
	echo "<tr>";
      for($k=1; $k<($n-1);$k++)	
	   {$value= mysql_result($q,$i,$k); $val=$names[($k-1)];
	    if ($val=='cover') {$str="<td> <font size=2>&nbsp;"; 
	                       $str.="<img src=\"http://test1.ru/"; 
						   $str.="$value"; 
						   $str.= " \" width=100 height=150 />"; 
						   $str.="</font></td>"; echo $str;}  
	    else {                           if ($val=='download') {if (mysql_result($q,$i,6)=='1')
		                                                               {$str="<td> <font size=2>&nbsp; ";
																	    $str.="<a href=\"http://test1.ru/";
																		$str.="$value"; 
																		$str.=" \" download> download </a> ";
																		$str.="</font></td>" ;} 
								         else {$str="<td> <font size=2>&nbsp;  </font></td>";};
		                                 echo $str;
										 } 
		          else {echo "<td> <font size=2>&nbsp; $value </font></td>";}
		       }
	   }
	$id=mysql_result($q,$i,0); echo "<td> <font size=2>&nbsp; <a href= \"edit.php?idd=$id\"  > редактировать </a> </font></td>";  
	echo "</tr>";
	}
echo "</table>";

?>


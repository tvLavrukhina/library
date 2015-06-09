<?php
session_start();
unset($_SESSION['passwd']);
unset($_SESSION['login']);
$conn=mysql_connect("localhost", "user","123") or die ("Ќевозможно установить соединение: ".mysql_error());  
mysql_query("set names 'cp1251',$conn");
mysql_select_db("book");                        
    if(isset($_GET['go']))    
     {$_SESSION['login']=$_GET['login'];
      $_SESSION['passwd']=$_GET['passwd'];
      if ($_GET['login']=="pit" && $_GET['passwd']=="123")
               {Header("Location: home.php");}
               else {echo "<br>ѕроверьте правильность логина и парол€<br>"; }
     }
        if(!isset($_GET['go']) or $_GET['login']!="pit" or $_GET['passwd']!="123")
        {
?>
<html>
<head> <title> Ћична€ библиотека книг</title> </head>
<body>
<h2>Ћична€ библиотека книг </h2>
 јвторизаци€ 

</body></html>
        <form action="index.php"> Login: <input type=text name=login>
                   Password: <input type=password name=passwd>
                           <input type=submit name=go value=Go> </form>
  <?      } ?>


<?php 
$table_name="mybooks";
  $list_f=mysql_list_fields("book", "mybooks",$conn); //список полей
  $n=mysql_num_fields($list_f);                       //число полей
   for($j=1; $j<$n;$j++)
   {$names[]=mysql_field_name($list_f, $j);}          // массив с именами полей
$sql="SELECT title, author, date, cover, download, permission FROM $table_name ORDER BY date DESC";
$q=mysql_query($sql,$conn) or die();
$m=mysql_num_rows($q);                                 // число строк в таблице
echo "&nbsp; <TABLE BORDER=0 CELLSPACING=0 width=90% align=centre><tr><TD BGCOLOR='#005533' align=centre> <font color='#FFFFFF'> <b> $table_name</b></font></td></tr></TABLE>";
echo "<table cellspacing=0 cellspacing=1 border=1 width=90% align=centre";
echo "<tr>";
for ($i=0;$i<($n-2);$i++){ $val=$names[$i]; echo "<th ALIGN=CENTER BGCOLOR='#C2E3B6'><font size=2>$val</font></th>";}  //строка с названи€ми
echo "</tr>"; 

for ($i=0;$i<$m;$i++){
	echo "<tr>";
      for($k=0; $k<($n-2);$k++)	
	   {$value= mysql_result($q,$i,$k); $val=$names[$k];
	    if ($val=='cover') {$str="<td> <font size=2>&nbsp;"; 
	                       $str.="<img src=\"http://test1.ru/"; 
						   $str.="$value"; 
						   $str.= " \" width=100 height=150 />"; 
						   $str.="</font></td>"; echo $str;}  
	      else {  if ($val=='download') {if (mysql_result($q,$i,5)=='1')
		                                                               {$str="<td> <font size=2>&nbsp; ";
																	    $str.="<a href=\"http://test1.ru/";
																		$str.="$value"; 
																		$str.=" \"download> download </a> ";
																		$str.="</font></td>" ;} 
								         else {$str="<td> <font size=2>&nbsp;  </font></td>";};
		                                 echo $str;
										 } 
		          else {echo "<td> <font size=2>&nbsp; $value </font></td>";}
		       }
	   }
	   
	echo "</tr>";
	}
echo "</table>";

?>






















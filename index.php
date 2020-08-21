<?php include_once "bd.php";
if(isset($_GET['out'])) {
setcookie("login", "");  
setcookie("pass", "");
 header("Location: index.php");
} 
?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>beejee</title>
  </head>
  <body style="background-color: #ece9e0;">
 
<div class="top" >
<a href="add.php"><input type="button" class="but" value="Создать задачу" onclick="" name="btn"></a>
<?php if($_COOKIE["login"]=="admin"){
echo "<a href='admin.php'><input type='button' style='right: 100px' class='but2' value='Админ панель' name='btn'></a><input type='button' class='but2' onclick='out()' value='Выход' name='btn'>";}else
{echo "<a href='admin.php'><input type='button' class='but2' value='Авторизироваться' name='btn'></a>";}
?>
</div>
<script>
function out(){
document.location.href = "index.php?out=on";
}
</script>


<?php
if (isset($_GET['page'])){
	$page = $_GET['page'];
}else $page = 1;

$kol = 3;  

$res = mysqli_query($link, "SELECT COUNT(*) FROM spisok");
$row = mysqli_fetch_row($res);
$total = $row[0];
$str_pag = ceil($total / $kol);

$art = ($page * $kol) - $kol;
$sort="";
$inso = "<a href='index.php?asc=1&na=name'>&#9650;</a>";
$inso2 = "<a href='index.php?asc=1&na=email'>&#9650;</a>";
$inso3 = "<a href='index.php?asc=1&na=status'>&#9650;</a>";
if(isset($_GET['na'])){$na=$_GET['na'];}else{$na="";}
if(isset($_GET['asc'])) {$sort="ORDER BY ".$na." ASC";
if($na=="name"){$inso = "<a href='index.php?desc=1&na=name'>&#9660;</a>";}
if($na=="email"){$inso2 = "<a href='index.php?desc=1&na=email'>&#9660;</a>";}
if($na=="status"){$inso3 = "<a href='index.php?desc=1&na=status'>&#9660;</a>";}
$num="&asc=1&na=".$na."";}
if(isset($_GET['desc'])) {$sort="ORDER BY ".$na." DESC";
if($na=="name"){$inso = "<a href='index.php?asc=1&na=name'>&#9650;</a>";}
if($na=="email"){$inso2 = "<a href='index.php?asc=1&na=email'>&#9650;</a>";}
if($na=="status"){$inso3 = "<a href='index.php?asc=1&na=status'>&#9650;</a>";}
$num="&desc=1&na=".$na."";}
$query ="
SELECT * FROM spisok ".$sort." LIMIT $art,$kol";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
	$rows = mysqli_num_rows($result); // количество полученных строк
	
	echo "<table border='1' cellpadding='5'><tr><th>Имя пользователя ".$inso."</th>
	<th>Email ".$inso2."</th>
	<th>Текст задачи</th><th>Статус ".$inso3."</th></tr>";
$ch="";
	for ($i = 0 ; $i < $rows ; ++$i)
	{
		$row = mysqli_fetch_row($result);
	if($row[4]=="on"){$ch="Активен";}else{$ch="В Ожидании";}if($row[5]=="on"){$red="<br> Отредактировано администратором";}else{$red="";}
		echo "<tr>";
			echo "<td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$ch $red</td>"; 
		echo "</tr>";
	}
	echo "</table>";
	// очищаем результат
	mysqli_free_result($result);
} 

if($page==1){$la=$page;}else{$la=$page-1;}
if($page==$str_pag){$ra=$page;}else{$ra=$page+1;}
echo "<div class='num'>";
echo "<a href=index.php?page=".$la.$num.">&lang;</a>";
for ($i = 1; $i <= $str_pag; $i++){
	echo "<a href=index.php?page=".$i.$num.">".$i." </a></li>";
}
echo "<a href=index.php?page=".$ra.$num.">&rang;</a>";
echo "</div>";

?>


</form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
  </body>
</html>
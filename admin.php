<?php include_once "bd.php";
$log="";$pas="";
if(isset($_POST['sub']))
{
$login= $_POST['login'];
$pass = $_POST['pass'];
$query = "SELECT * FROM auth WHERE auth.name='$login'";
$result = mysqli_query($link, $query); 
if(mysqli_num_rows($result) == 1){
$row = mysqli_fetch_row($result); 
if($row[2]==$pass){
setcookie("login", $row[1], time()+50000);  
setcookie("pass", $row[2], time()+50000);
$_SESSION['id'] = $row[0];
 header("Location: admin.php");
}else{//не совпадает пароль	
$pas = "<script type='text/javascript'>document.getElementsByClassName('error')[0].style.display='block';document.getElementsByClassName('error')[0].innerHTML='<span><br>Неправельный введен пароль<br>&nbsp;</span>';</script>";
}
}else{//такого пользователя нет
$log = "<script type='text/javascript'>document.getElementsByClassName('error')[0].style.display='block';document.getElementsByClassName('error')[0].innerHTML='<span><br>Неправельный введен логин<br>&nbsp;</span>';</script>";
}} 
if(isset($_GET['del'])) {
if($_COOKIE["login"]!="admin"){header("Location: admin.php");}else{
$del=$_GET['del'];
$query ="DELETE FROM spisok WHERE id=$del";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); }
} 
if(isset($_GET['out'])) {
setcookie("login", "");  
setcookie("pass", "");
 header("Location: admin.php");
} 
if(isset($_POST['btn'])){
if($_COOKIE["login"]!="admin"){header("Location: admin.php");}else{
$id=$_GET['id'];
$name=$_POST['name'];$pass=$_POST['mail'];$text=$_POST['text'];$edit=$_GET['edit'];
$query ="UPDATE `spisok` SET `name` = '$name', `email` = '$pass', `text` = '$text', `edit` = '$edit' WHERE `spisok`.`id` = $id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
}}
if(isset($_GET['name'])) {
	if($_COOKIE["login"]!="admin"){header("Location: admin.php");}else{
$check=$_GET['name'];$id=$_GET['id'];
$query ="UPDATE `spisok` SET `status` = '$check' WHERE `spisok`.`id` = $id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	}
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
<a href="index.php"><input type="button" class="but" value="Список задач" onclick="" name="btn"></a>
<a href="add.php"><input type="button" class="but" value="Создать задачу" onclick="" name="btn"></a>
<?php if($_COOKIE["login"]=="admin"){
echo "<a href='admin.php'><input type='button' style='right: 100px' class='but2' value='Админ панель' name='btn'></a><input type='button' class='but2' onclick='out()' value='Выход' name='btn'>";}else
{echo "<a href='admin.php'><input type='button' class='but2' value='Авторизироваться' name='btn'></a>";}
?>
<script>
function out(){
document.location.href = "admin.php?out=on";
}
</script>
</div>
<center> <span id='error' class='error' style='display:none'></center>
<?php if($_COOKIE["login"]!="admin"){ 
 echo "<center> <form class='auth' action='#' method='post'> 
	
      <label>Введите имя:</label><br>
      <input type='text' name='login' placeholder='Имя' required ><br><br>
      <label>Введите пароль:</label><Br>
      <input type='password' name='pass' placeholder='Пароль' required ><br><br>
      <button class='form_auth_button' type='submit' name='sub'>Войти</button>
    </form>
	</center>";
} ?>



<?php
if($_COOKIE["login"]=="admin"){ 
$query ="
SELECT * FROM spisok";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
	$rows = mysqli_num_rows($result); // количество полученных строк
	
	echo "<table border='1' cellpadding='5'><tr><th>Имя пользователя</th><th>Email</th><th>Текст задачи</th><th>Статус</th></tr>";
$ch="";
	for ($i = 0 ; $i < $rows ; ++$i)
	{
		$row = mysqli_fetch_row($result);
		if($row[4]=="on"){$ch="checked";$check="off";}else{$check="on";$ch="";} $idd=$row[0];
		echo "<tr>";
			echo "<td>$row[1]</td><td>$row[2]</td><td>$row[3]</td>
			<td><a href='admin.php?name=".$check."&id=".$idd."'><input type='checkbox' onclick='qwe()' name='a' ".$ch." disabled>вкл/выкл</a></td>
			<td><a name='del' href='admin.php?del=".$row[0]."'>Удалить</a></td>
			<td><a name='red' href='red.php?id=".$row[0]."&name=".$row[1]."&pass=".$row[2]."&text=".$row[3]."'>Редактировать</a></td>"; 
		echo "</tr>";
	}
	echo "</table>";
	// очищаем результат
	mysqli_free_result($result);
} 
}

?>
<?php echo $log; echo $pas;?>


</form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
  </body>
</html>
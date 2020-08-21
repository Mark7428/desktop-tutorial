<?php include_once "bd.php";
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
}else{//не совпадает пароль	
}
}else{//такого пользователя нет
}} ?>
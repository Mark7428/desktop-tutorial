<?php include_once "bd.php"; ?>

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
  <body>
  
<div class="top" >
<input type="button" class="but" onclick="zadan()" value="Список задач" onclick="" name="btn">
<?php if($_COOKIE["login"]=="admin"){
echo "<input type='button' style='right: 100px' onclick='admin()' class='but2' value='Админ панель' name='btn'><input type='button' class='but2' onclick='out()' value='Выход' name='btn'>";}else
{echo "<input type='button' class='but2' onclick='admin()' value='Авторизироваться' name='btn'>";}
?>
</div>
<script>
function out(){
document.location.href = "index.php?out=on";
}
</script>
<form method="POST" class="contact_form">
<div class="dv">
<center> <span id='error' class='error' style='display:none;'></center>
  <form action="/action_page.php">

    <label id="name" for="fname">Имя пользователя</label>
    <input type="text" id="fname" name="name" placeholder="Ваше Имя..">
<br>
    <label id="email" for="lname">Email</label><br>
    <input type="text" id="lname" name="mail" placeholder="Email..">
	<br>
	    <label for="lname">Текст задачи</label><br>
<textarea rows="2" name="text"></textarea>
    <input type="submit" value="Создать задачу" name="btn">
  </form>
</div>




<?php

    if( isset( $_POST['btn'] ) )
    {$ok=0;
		$name=$_POST['name'];if($name==""){
echo "<script type='text/javascript'>if(!document.getElementById('error_name')){
	document.getElementById('name').innerHTML+=`<span id='error_name' class='error' style='display: block;'><span>Введите пожалуйста имя пользователя</span></span>`;}
	</script>";$ok=1;}
	
$mail=$_POST['mail'];$mok1=strpos($mail, "@");$mok2=strpos($mail, ".");
if($mail!=""){if($mok1 === false||$mok2 === false){
echo "<script type='text/javascript'>if(!document.getElementById('error_name')){
document.getElementById('email').innerHTML+=`<span id='error_mail' class='error' style='display: block;'><span>Неправельный формат почты<br>.</span></span>`;
}</script>";$ok=1;}}else{
echo "<script type='text/javascript'>if(!document.getElementById('error_name')){
document.getElementById('email').innerHTML+=`<span id='error_mail' class='error' style='display: block;'><span>Введите пожалюйста mail<br>.</span></span>`;}
	</script>";$ok=1;}
		
$name=$_POST['name'];$mail=$_POST['mail'];$text=$_POST['text'];

if($ok==0){
$query ="
INSERT INTO `spisok` (`id`, `name`, `email`, `text`, `status`) 
VALUES (NULL, '$name', '$mail', '$text', '');";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
	echo "<script>document.getElementsByClassName('error')[0].style.display='block';
	document.getElementsByClassName('error')[0].innerHTML=`<span id='uspeh' style='background-color: green;'><br>Вы успешно создали задачу<br>&nbsp;</span>`;
	</script>";
}
 mysqli_close($link);
}
}
 

?>
<script>
function admin(){
document.location.href = "admin.php";
}
function zadan(){
document.location.href = "index.php";
}
</script>

<script type="text/javascript">
document.querySelector('#fname').onclick = function(){
	if(document.getElementById('error_name')){
document.getElementById('error_name').remove();} 
if(document.getElementById('uspeh')){
document.getElementById('uspeh').remove();} 
  }
  document.querySelector('#lname').onclick = function(){
	if(document.getElementById('error_mail')){
document.getElementById('error_mail').remove();}  
if(document.getElementById('uspeh')){
document.getElementById('uspeh').remove();} 
  }
  </script>
</form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
  </body>
</html>
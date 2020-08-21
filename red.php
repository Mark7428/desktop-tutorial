<?php if($_COOKIE["login"]!="admin"){header("Location: admin.php");} ?>
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
</div>
<?php
$name=$_GET['name'];
$pass=$_GET['pass'];
$text=$_GET['text'];
$id=$_GET['id'];
?>
<form action="admin.php?id=<?php echo $id;?>&edit=on" method="POST" class="contact_form">
<div class="dv">


    <label id="name" for="fname">Имя пользователя</label>
    <input type="text" value="<?php echo $name; ?>" id="fname" name="name" placeholder="Ваше Имя..">
<br>
    <label id="email" for="lname">Email</label><br>
    <input type="text" value="<?php echo $pass; ?>" id="lname" name="mail" placeholder="Email..">
	<br>
	<label for="lname">Текст задачи</label><br>
<textarea rows="2" name="text"><?php echo $text; ?></textarea>
    <input type="submit" value="Изменить" name="btn">

</div>

</form>

<script>

function zadan(){
document.location.href = "index.php";
}

</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
  </body>
</html>
<?php $link = @new mysqli('p573483.mysql.ihc.ru', 'p573483_bj', 'bj123456', 'p573483_bj');
  if (mysqli_connect_errno()) {
    echo "Подключение невозможно: ".mysqli_connect_error();
  }
  mysqli_set_charset($link, "utf8"); ?>
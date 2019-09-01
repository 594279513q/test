<!DOCTYPE html>
<html>
<head>
<meta charset="utf-32">
</head>
<body>
<?php
require_once 'connection.php'; // подключаем скрипт
 
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['secondname'])){
 
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 
     
    // экранирования символов для mysql
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $surname = htmlentities(mysqli_real_escape_string($link, $_POST['surname']));
	$secondname = htmlentities(mysqli_real_escape_string($link, $_POST['secondname']));
     
    // создание строки запроса
    $query ="INSERT INTO test_table VALUES(NULL, '$name','$surname','$secondname')";
     
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
	
	$query ="SELECT * FROM test_table";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
     
    echo "<table><tr><th>Имя</th><th>Фамилия</th><th>Отчество</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
     
    // очищаем результат
    mysqli_free_result($result);
}
		
    // закрываем подключение
    mysqli_close($link);
}
?>
<h2>Добавить новую запись</h2>
<form method="POST">
<p>Введите имя:<br> 
<input type="text" name="name" /></p>
<p>Фамилия: <br> 
<input type="text" name="surname" /></p>
<p>Отчество: <br> 
<input type="text" name="secondname" /></p>
<input type="submit" value="Добавить">
</form>
</body>
</html>
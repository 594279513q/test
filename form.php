<!DOCTYPE html>
<html>
<head>
<meta charset="utf-32">
</head>
<body>
<?php
require_once 'connection.php'; // ���������� ������
 
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['secondname'])){
 
    // ������������ � �������
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("������ " . mysqli_error($link)); 
     
    // ������������� �������� ��� mysql
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $surname = htmlentities(mysqli_real_escape_string($link, $_POST['surname']));
	$secondname = htmlentities(mysqli_real_escape_string($link, $_POST['secondname']));
     
    // �������� ������ �������
    $query ="INSERT INTO test_table VALUES(NULL, '$name','$surname','$secondname')";
     
    // ��������� ������
    $result = mysqli_query($link, $query) or die("������ " . mysqli_error($link)); 
    if($result)
    {
        echo "<span style='color:blue;'>������ ���������</span>";
    }
	
	$query ="SELECT * FROM test_table";
 
$result = mysqli_query($link, $query) or die("������ " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // ���������� ���������� �����
     
    echo "<table><tr><th>���</th><th>�������</th><th>��������</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
     
    // ������� ���������
    mysqli_free_result($result);
}
		
    // ��������� �����������
    mysqli_close($link);
}
?>
<h2>�������� ����� ������</h2>
<form method="POST">
<p>������� ���:<br> 
<input type="text" name="name" /></p>
<p>�������: <br> 
<input type="text" name="surname" /></p>
<p>��������: <br> 
<input type="text" name="secondname" /></p>
<input type="submit" value="��������">
</form>
</body>
</html>
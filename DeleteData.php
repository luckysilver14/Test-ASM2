<!DOCTYPE html>
<html>
<body>

<h1>Delete Data</h1>

<h4>ID SP cần xóa</h4>

<form name="delete" method="POST" action="DeleteData.php">
    <lable for="id">Product ID</label><input type="text" name="id" placeholder="Enter ID of the product that you want to delete"/><br>
    <input type="submit" value="Delete">
</form>

<?php
ini_set('display_errors', 1);
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-34-200-72-77.compute-1.amazonaws.com;port=5432;user=ounxycojxvijaq;dbname=d2enakpnef9nqm;password=8944c1cb6cb4c6192ecbfeddda74124479826aae73eebfa999399bf06b44be2c",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "DELETE FROM Products WHERE ProductID = '$_POST[id]'";
$stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "deleted successfully.";
} else {
    echo "Error deleting record: ";
}

?>
</body>
</html>

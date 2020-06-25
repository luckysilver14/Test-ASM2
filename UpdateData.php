<!DOCTYPE html>
<html>
<body>

<h1>Product Data Update</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<form name="update" action="UpdateData.php" method="POST">
    <label for="id">Product ID</label><input type="text" name="id" placeholder="nhập 1 id sản phẩm"/>
    <label for="newname">New name</label><input type="text" name="newname" placeholder="nhập tên mới cho id sản phẩm"/><br>
    <input type="submit" value="Cập Nhật">
</form>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-34-200-72-77.compute-1.amazonaws.com;port=5432;dbname=d2enakpnef9nqm;user=ounxycojxvijaq;password=8944c1cb6cb4c6192ecbfeddda74124479826aae73eebfa999399bf06b44be2c",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

//$sql = 'UPDATE student '
//                . 'SET name = :name, '
//                . 'WHERE ID = :id';
// 
//      $stmt = $pdo->prepare($sql);
//      //bind values to the statement
//        $stmt->bindValue(':name', 'Lee');
//        $stmt->bindValue(':id', 'SV02');
        // update data in the database
//        $stmt->execute();

        // return the number of row affected
        //return $stmt->rowCount();
$sql = "UPDATE Products SET ProductName = '$_POST[newname]' WHERE ProductID = '$_POST[id]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>

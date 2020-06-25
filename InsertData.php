<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>Insert Data into table Product</h1>
    <ul>
        <form name="InsertData" action="InsertData.php" method="POST" >
            <li>Product ID:</li><li><input type="text" name="product_id" /></li>
            <li>Product Name:</li><li><input type="text" name="product_name" /></li>
            <li>Release Date</li><li><input type="date" name="release_date" /></li>
            <li><input type="submit" value="Submit" /></li>
        </form>
    </ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-34-200-72-77.compute-1.amazonaws.com;port=5432;dbname=d2enakpnef9nqm;user=ounxycojxvijaq;password=8944c1cb6cb4c6192ecbfeddda74124479826aae73eebfa999399bf06b44be2c",
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";
$sql = "INSERT INTO Products(ProductID, ProductName, ReleaseDate) VALUES ('$_POST[product_id]','$_POST[product_name]', '$_POST[release_date]')";
$stmt = $pdo->prepare($sql);

    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record.";
    }

?>
</body>
</html>

<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./mainstyle.css"/>
    <title>ATN Database</title>
</head>
<body>
        <?php
        ini_set('display_errors', 1);
        if (empty(getenv("DATABASE_URL"))){
            $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
        }  else {
            echo getenv("dbname");
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

        $sql = "SELECT * FROM products ORDER BY product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>ATN's Database</h1>
    <button onclick="location.href='index.php'">Back to homepage</button>
    <div class="container">
        <div class="grid-view">
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#" onClick="displayData()"><b>Products data</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png" />
                <a href="./InsertData.php" target="framename"><b>Add product data</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="./DeleteData.php" target="framename"><b>Delete data</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="UpdateData.php" target="framename"><b>Update data</b></a>
            </div>
            <div id ="displaychange" class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>Product_ID</th>
                        <th>Product_name</th>
                        <th>Release_Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // tạo vòng lặp 
                        //while($r = mysql_fetch_array($result)){
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['product_id'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td><?php echo $row['release_date'] ?></td>     
                    </tr>
                    
                    <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./data.js"></script>
</body>
</html>
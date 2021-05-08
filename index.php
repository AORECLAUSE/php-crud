<?php
$pdo = new PDO('mysql:local;port=3306;dbname=products_crud','root','');
$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$statement = $pdo ->prepare('SELECT * FROM products ORDER BY create_date DESC');
$statement ->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>Product CRUD</title>
</head>

<body>
    <h1>Product CRUD</h1>
    <p>
    <a class="btn btn-success" href="create.php" role="button">Create</a>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">create Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
           foreach($products as $i => $product){ ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>
                <td></td>
                <td><?php echo $product['title'] ?></td>
                <td><?php echo $product['price'] ?></td>
                <td><?php echo $product['create_date '] ?></td>
                <td><button type="button" class="btn btn-sm btn-outline-primary">EDIT</button>
                <button type="button" class="btn btn-sm btn-outline-danger">DELETE</button></td>
            </tr>
       <?php }?>
        </tbody>
    </table> 
</body>

</html> 
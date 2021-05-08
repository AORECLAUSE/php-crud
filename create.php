<?php
$pdo = new PDO('mysql:local;port=3306;dbname=products_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = date('Y-m-d H:i:s');
   
    if (!$title) {
        $echo[] = 'title is required';
    }
    if (!$price) {
        $echo[] = 'price is required';
    }



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $statement  = $pdo->prepare("INSERT INTO products (title,image,description,price,create_date)
                VALUES (:title, :image ,:description,:price,:date)");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', '');
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', $date);
        $statement->execute();
    }
}
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
    <h1>CREATE NEW PRODUCT</h1>
    <?php
    foreach ($errors as $error) : ?>
        <div><?php echo $error ?></div>
    <?php endforeach  ?>
    </div>
    <form action="" method="post">
        <div class="mb-3">
            <label>Product Image</label>
            <input type="file" name="image" class="form-control">
            <div class="mb-3">
                <label>Product Title</label>
                <input type="text" name="title" class="form-control">
                <div class="mb-3">
                    <div class="mb-3">
                        <label>Product Description</label>
                        <textarea name="description" class="form-control"> </textarea>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label>Product Price</label>
                                <input type="number" name="price" step="0.1" class="form-control">
                                <div class="mb-3">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>
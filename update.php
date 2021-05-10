<?php
$pdo = new PDO('mysql:local;port=3306;dbname=products_crud', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$statement  = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$statement -> bindValue(':id',$id);
$statement -> execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

$errorS = [];
$title = $product['title'];
$price = $product['price'];
$description = $product['description'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (!$title) {
        $errors[] = 'title is required';
    }
    if (!$price) {
        $errors[] = 'price is required';
    }
    if (!is_dir('images')) {
        mkdir('images');
    }
    if (empty($errors)) {
        $image = $_FILES['image'] ?? null;
        $imagePath = $product['image'];
        

        if ($image && $image['tmp_name']) {

            if ($product['image']) {
                unlink($product['image']);
            }
            $imagePath = 'images/'.randomString(8).'/'.$image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image["tmp_name"], $imagePath);
        }
        $statement  = $pdo->prepare("UPDATE products SET title = :title,image = :image,description = :description,price = :price WHERE id = :id");
        $statement->bindValue(':id', $id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->execute();
        header('Location: index.php');
    }
}
function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>Product CRUD</title>
</head>

<body>
<p>
<a href="index.php" class="btn btn-secondary">Go back to products</a>
</p>
    <h1>UPDATE PRODUCT <p><?php echo $product['title']?></p></h1>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php
            foreach ($errors as $error) : ?>
                <div><?php echo $error ?></div>
            <?php endforeach  ?>
        </div>
    <?php endif ?>
    <form action="" method="post" enctype="multipart/form-data">
    <?php if ($product['image']): ?>
    <img src="<?php echo $product['image']?>" class="update-image">
        <?php endif ?>
        <div class="mb-3">
            <label>Product Image</label>
            <input type="file" name="image" class="form-control">
            <div class="mb-3">
                <label>Product Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
                <div class="mb-3">
                    <div class="mb-3">
                        <label>Product Description</label>
                        <textarea name="description" class="form-control"><?php echo $description ?></textarea>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label>Product Price</label>
                                <input type="number" name="price" step="0.1" class="form-control" value="<?php echo $price ?>">
                                <div class="mb-3">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>
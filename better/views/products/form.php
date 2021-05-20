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
    <img src="/<?php echo $product['image']?>" class="update-image">
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
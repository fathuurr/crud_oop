<?php 
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imagePath = '';

    if(!$title) {
    $errors[] = 'Product title must be provided';
    }
    if (!$price) {
    $errors[] = 'Product price must be provided';
    }

    if (!is_dir('images')) {
    mkdir('images');
    }

    if (empty($errors)) {
        $image = $_FILES['image'] ?? null;
        $imagePath = $products['image'];

        if ($products['image']) {
            unlink($products['image']);
        }

        if ($image && $image['tmp_name'] ) {
            if ($products['image']) {
                unlink($products['image']);
            }

            $imagePath = 'images/'.randomString(8).'/'.$image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
    }

?>
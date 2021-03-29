<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'] ?? null;

    if (!$id) {
        header("Location: index.php");
        exit;
    }

    $statement = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $statement->bindValue(":id", $id);
    $statement->execute();
    $products = $statement->fetch(PDO::FETCH_ASSOC);

    $errors = [];
    
    $title = $products['title'];
    $price = $products['price'];
    $description = $products['description'];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];

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

        $statement = $pdo->prepare("UPDATE products SET title = :title, image = :image, description = :description, price = :price WHERE id = :id");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(":id", $id);
        $statement->execute();
        header("Location: index.php");
      }

    }

    function randomString ($n) {
      $characters = '012345689abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $str = '';
      for ($i = 0; $i < $n ; $i++) { 
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
      }

      return $str;
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="app.css">

    <title>Product CRUD</title>
  </head>
  <body>
    <a href="index.php" class='btn btn-secondary' > Go back to products </a>
    <h1 class='d-flex text-center'>Update Product <b style="text-indent: 10px;" ><?= $products['title'] ?> </b></h1>

  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error ): ?>
          <div> <?= $error ?> </div>
        <?php endforeach; ?>
    </div>
  <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" >

            <?php if ($products['image']) : ?>
                <img src="<?= $products['image'] ?>" alt="image" width="120" >
            <?php endif; ?>

      <div class="mb-3">
        <label class='form-label'>Product Image </label>
        <input
          type="file"
          class="form-control"
          name="image"
        />
      </div>
      <div class="mb-3">
        <label  class="form-label">Product Title</label>
        <input
          type="text"
          class="form-control"
          name="title"
          value="<?= $title ?>"
        />
      </div>
      <div class="mb-3">
        <label  class="form-label">Description</label>
        <textarea
          class="form-control"
          name="description"
        ><?php echo $description ?></textarea>
      </div>
      <div class="mb-3">
        <label  class="form-label">Product Price</label>
        <input
          type="number"
          step=".01"
          class="form-control"
          name="price"
          value="<?= $price ?>"
        />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

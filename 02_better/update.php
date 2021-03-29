<?php
    /**  @var $pdo \PDO  */
    require_once "database.php";
    require_once "functions.php";


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
      require_once "form_validation.php";
      if (empty($errors)) {
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

?>


<?php include_once "views/partials/header.php" ?>

    <a href="index.php" class='btn btn-secondary' > Go back to products </a>
    <h1 class='d-flex text-center'>Update Product <b style="text-indent: 10px;" ><?= $products['title'] ?> </b></h1>

  <?php include_once "views/products/form.php" ?>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

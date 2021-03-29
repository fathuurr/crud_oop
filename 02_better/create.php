<?php
    /**  @var $pdo \PDO  */
    require_once "database.php";
    require_once "functions.php";

    $errors = [];
    
    $title = '';
    $price = '';
    $description = '';
    $products = [
      'image' => ''
    ];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once "form_validation.php";

      if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO products(title, image, description, price, create_date) 
                                    VALUES(:title, :image, :description, :price, :date) ");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $statement->execute();
        header("Location: index.php");
      }

    }
?>


<?php include_once "views/partials/header.php" ?>

    <a href="index.php" class='btn btn-secondary' > Go back to products </a>
    <h1 class='d-flex text-center'>Create new Product</h1>
    
    <?php include_once "views/products/form.php" ?>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

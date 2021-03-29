<?php
    /**  @var $pdo \PDO  */
    require_once "database.php";

    $search = $_GET['search'] ?? '';

    if ($search) {
      $statement = $pdo->prepare("SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC");
      $statement->bindValue(":title", "%$search%");
    } else {
      $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
    }
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include_once "views/partials/header.php" ?>
    <h1 class='d-flex text-center'>Product CRUD</h1>
    <p>
        <a href="create.php" class='btn btn-success' >Create Product</a>
    </p>
    
    <form>
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          name="search"
          placeholder="Search the products"
          value="<?= $search ?>"
        />
        <button type="submit" class="btn btn-outline-secondary">Search</button>
      </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Create Date</th>
                <th scope="col">Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $i => $product ) : ?>
                <tr>
                    <th scope="row"> <?= $i + 1 ?> </th>
                    <td> <img src="<?= $product['image'] ?>" alt="img" width="50" > </td>
                    <td><?= $product['title'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['create_date'] ?></td>
                    <td>
                        <a href="update.php?id=<?= $product['id'] ?>" class='btn btn-sm btn-outline-primary'>Edit</a>
                        <form action="delete.php" method="POST" style="display: inline-block;" >
                          <input type="hidden" name="id" value="<?= $product['id'] ?>" >
                          <button type="submit" class='btn btn-sm btn-outline-danger'>Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>   
        </tbody>
        </table>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

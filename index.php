<!-- index.php - Homepage -->
<?php
include 'includes/../db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../Fruit/main.js"></script>
  <link rel="stylesheet" href="./main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Fresh Fruits & Vegetables</h1>
        </div>
        <div class="container-md mt-5">
        
      <div class="row">
        <div class="col-lg-6 col-12 pt-3 mt-5">
          <div class="pt-3">
            <h1 class="display-5">Taste The Difference</h1>
            <h2 class="h3 text-primary mb-4" style="font-family: courgete;">Delivered To Your Door!</h2>
            <p>We're dedicated to bringing exceptional flavors straight to your door. Our handpicked menu, crafted by
              passionate chefs, promises a culinary adventure with every order. Enjoy restaurant-quality meals,
              conveniently delivered for your pleasure. Explore the taste of convenience today!</p>
            <div class="d-grid d-sm-flex justify-content-sm-center mt-4">
            <a href="user/signup.php" class="btn btn-primary ms-lg-5">Sign Up</a>
            </div>

          </div>
        </div>
        <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade show active" id="nav-main-courses" role="tabpanel"
          aria-labelledby="nav-main-courses-tab">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col">
        <div class="products">
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card-body' style='width: 24rem;'>
                        <img src='./images/" . $row['image'] . "' alt='" . $row['name'] . "' class='card-img-top'>
                        <div class='card-title'>
                            <h2>" . $row['name'] . "</h2>
                            <p>$" . $row['price'] . "</p>
                        </div>
                        </div>
                      </div>";
            }
            ?>
            </div>
        </div>
        </div>
    </div>
    </div> 
    <?php include 'includes/../user/feedback.php'; ?>
    <?php include 'includes/../user/footer.php'; ?>
</body>
</html>
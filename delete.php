<?php 

$incorrect_ref = 1;


$conn = mysqli_connect('localhost', 'root', '', 'shopNow_werehouse' );

/////////////////////

$sql = 'SELECT * FROM products';

//////////////////////

$result = mysqli_query($conn,$sql);

//////////////////////

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

///////////////////////


if(isset($_POST['delete'])) {
  $ref_to_delete = mysqli_real_escape_string($conn, $_POST['ref_to_delete']);

  $sql = "DELETE FROM products WHERE Reference = $ref_to_delete";

  if(mysqli_query($conn,$sql)) {
    header("Location: delete.php");
  } else {
    echo "query error" . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ShopNow | manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="delete-page/deleteStyle.php" />
    <link rel="stylesheet" href="search-page/query.php" />
  </head>
  <body>
  <?php include('reusable/header.php'); ?>

    <!-- /////////////////////////////////////////// -->
    <main>
    <?php include('reusable/search-form.php'); ?>



      <?php if(isset($_POST['submit'])) { ?>
        <?php foreach($products as $product) {
          if($_POST['ref'] == $product['Reference']) { ?>
      <div id="goto" class="cnt_of_main">
        <h1 class="head_one">product</h1>
        <form action="delete.php" method="POST">
          <div class="cnt_of_form">
            <label class="label" for="ref">Reference Number</label>
            <p class="product_infos reference_number_paragraph"><?php echo htmlspecialchars($product['Reference']) ?></p>
          </div>
          <div class="cnt_of_form">
            <label class="label" for="ref">Name</label>
            <p class="product_infos Name_paragraph"><?php echo $product['Name'] ?></p>
          </div>
          <div class="cnt_of_form">
            <label class="label" for="ref">Category</label>
            <p class="product_infos Category_paragraph"><?php echo $product['Category'] ?></p>
          </div>
          <div class="cnt_of_form">
            <label class="label" for="ref">quantity</label>
            <p class="product_infos quantity_paragraph"><?php echo $product['quantity'] ?> pcs</p>
          </div>
          <div class="cnt_of_form spaecial_margin_bottom">
            <input type="hidden" name="ref_to_delete" value="<?php echo $product['Reference'] ?>">
            <input type="submit" name="delete" value="delete" class="anchor_search">
          </div>
        </form>
      </div>
      <?php $incorrect_ref = 0; } ?>
      <?php } ?>
      <?php } ?>

      <?php if($products == null) { ?>
            <p class="no_product_found"> there is no product at all check out the <a class="home_anchor" href="index.php">home page</a> </p>
      <?php $incorrect_ref = 0; } ?>

      <?php if(isset($_POST['submit'])) { ?>
      <?php if($incorrect_ref !== 0) { ?>
          <p class="no_product_found">sorry, we couldn't find any result</p>
      <?php } ?>
      <?php } ?>
      

    </main>
    <!-- /////////////////////////////////////////// -->
    <?php include('reusable/end.php'); ?>
  </body>
</html>

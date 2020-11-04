<?php
  $conn = new mysqli('localhost','kaze','alien','tofu');

  $code = $_COOKIE['code'];

  $sql = "SELECT dish_name,description,dish_price,count FROM dish WHERE rest_code = $code";

  $result = mysqli_query($conn, $sql);

  $dishes = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $rest = "SELECT rest_name FROM restaurant WHERE code = $code";

  $result = mysqli_query($conn, $rest);

  $restcode = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Order</title>
  <link href="../css/second.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Pacifico&family=Yellowtail&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
  <script src="../javascript/second.js" async></script>
</head>
<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th,
  td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  .heading{
    text-align: center;
  }
</style>

<body>
  <div class="display">
    <div class="heading"><?php echo "Welcome to ". $restcode['rest_name'] . " restaurant"?></div>
    <table id="table" style="font-family: 'Noto Sans JP', sans-serif;"> <?php foreach($dishes as $dish): ?>
      <tr class="docRow">
        <td class="name"><?php echo $dish['dish_name']; ?></td>
        <td class="desc"><?php echo $dish['description'];?></td>
        <td class="price"> <?php echo "Rs". $dish['dish_price'];?></td>
        <td><button class="butt" style="color:white;">+</button></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <div class="open-popup">
      <button class="view">View full order</button>
    </div>
    <div class="popup">
      <div class="body">
        <div class="header">
          <h3>Order Summary</h3>
          <button class="close-popup">&times;</button>
        </div>
        <section class="container content-section">
          <div class="cart-rows">
            <span class="cart-item cart-header cart-column">Dish</span>
            <span class="cart-price-header cart-header cart-column">Price</span>
            <span class="cart-quantity cart-header cart-column">Quantity</span>
          </div>
          <div class="cart-items">
          </div>
          <div class="cart-total">
            <span class="cart-total-title">Total</span>
            <span class="cart-total-price">Rs0</span>
          </div>
          <button class="btn btn-primary btn-send">Send to Chef</button>
        </section>
      </div>
    </div>
</body>

</html>

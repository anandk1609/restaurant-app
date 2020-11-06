<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Pacifico&family=Poppins:wght@200&family=Yellowtail&display=swap" rel="stylesheet">
    <script src="../javascript/third.js" async></script>
    <link href="../css/third.css" rel="stylesheet">
</head>
<body>
    <?php
        //error_reporting(E_ERROR | E_PARSE);
        $dishes = ($_SESSION['trial']);
        if(isset($_SESSION['coun']))
        {
          $newArray = ($_SESSION['beat']);
          $merge = array_merge($dishes, $newArray);
        }
        if(isset($_SESSION['coun'])){
          $name = array_column($merge, 'name');
          $price = array_column($merge, 'finalPrice');
          $quantity = array_column($merge, 'quantity');
          session_unset();
        }else{
          $name = array_column($dishes, 'name');
          $price = array_column($dishes, 'finalPrice');
          $quantity = array_column($dishes, 'quantity');
        }
    ?>
   <h3 class="header">Order Summary</h3>
    <table id="table">
      <tr>
        <th>Dish</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
      <tr><?php foreach(range(0,sizeof($name)-1) as $i): ?>
        <td class="name"><?php echo $name[$i]; ?></td>
        <td class="quantity"><?php echo $quantity[$i];?></td>
        <td class="price"> <?php echo "Rs". $price[$i];?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <div class="cart-total">
            <strong class="cart-total-title">Total</strong>
            <span id="cart-total-price">Rs0</span>
    </div>
    <div class="gst">
        <strong class="gst-title">GST@18%</strong>
        <span class="gst-price"></span> 
    </div>
    <div class="total">
        <strong class="total-title">Amount Payable</strong>
        <span class="total-price">Rs0</span> 
    </div>
    <div class="moreButtons">
        <button class="order" onclick="window.location.href='second.php'">Order More</button>
        <button class="payment" onclick="window.location.href='../otp/fourth.php'">Proceed to payment</button>
    </div>
</body>
</html>

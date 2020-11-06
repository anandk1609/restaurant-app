<?php
  $conn = new mysqli('localhost','kaze','alien','tofu');

  if($conn->connect_error){
    die('Connection failed: '.$conn->connect_error);
  }else{
    $code = $count = $table_no = "";
    $errors = array('code'=> '', 'count'=>'', 'table_no'=>'');
    if(isset($_POST['submit'])){

    if(empty($_POST['code'])){
      $errors['code']="Restaurant code is required <br />";
    }

    if(empty($_POST['count'])){
      $errors['count']="A neccessary field<br />";
    }

    if(empty($_POST['table_no'])){
      $errors['table_no']="Choose one from the list<br />";
    }

    if(!array_filter($errors)){
      session_start();
      $_SESSION['code']=$code = $_POST['code'];
      $_SESSION['count']=$count= $_POST['count'];
      $_SESSION['table_no']=$table_no= $_POST['table_no'];

      $sql = $conn->prepare("insert into reservation(recode,count,tableno) values(?,?,?)");
      $sql->bind_param("iii",$code, $count, $table_no);
      $sql->execute();
      $sql->close();
      header("Location: second.php");
    }
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/first.css" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
</head>
<body>
  <section class="container">
    <h3>Start Page</h3>
    <form class="box" action="first.php" method="POST">
      <label for="coder">Enter restaurant code:</label>
      <input class="textbox" type="number" name="code" id="coder" value="<?php echo $code; ?>">
      <div class="text"><?php echo '*'. $errors['code']; ?></div>
      <label for="counts">Specify your headcount:</label>
      <input class="textbox" type="number" name="count" id="counts" value="<?php echo $count;?>">
      <div class="text"><?php echo "*". $errors['count']; ?></div>
      <label>Select Table from the list</label>
      <div class = "custom-select">
          <select class="select-css" name="table_no">
            <option disabled selected>--Please select an option--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
          </select>
      </div>
      <div class="text"><?php echo "*". $errors['table_no']; ?></div>
      <a href="second.php"><input class="btn" type="submit" name="submit" value="submit" /></a>
    </form>
  </section>
</body>
</html>
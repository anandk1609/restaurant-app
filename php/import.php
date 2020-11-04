<?php
session_start();
$data= json_decode($_POST['dishData'], true);
// $data1= serialize($_POST['dishData']);
// var_dump($data);
// var_dump($data[1]['name']);
$conn = new mysqli('localhost','kaze','alien','tofu');
if(!isset($_COOKIE['no'])){
    setcookie("no","1",time() + (20 * 365 * 24 * 60 * 60), "/");
}
$_SESSION['total'] = $data[count($data) -2]['total'];
$_SESSION['gst'] = $data[count($data) -1]['gst'];


foreach ($data as $datas){
    $name = $datas['name'];
    $price = $datas['price'];
    $quantity = $datas['quantity'];
    $sql = $conn->prepare("insert into orders(dish,quantity,price,order_no) values(?,?,?,?)");
    $sql->bind_param("siii", $name, $quantity, $price, $_COOKIE['no'] );
    $sql->execute();
}
$sql->close();
$_COOKIE['no']++;
?>
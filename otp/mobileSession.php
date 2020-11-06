<?php
session_start();
$gotu=($_POST['data']);
$number = intval($gotu['number']);
$name = $gotu['custname'];
setcookie("custname","$name",time() + 10 * 60 * 60, false,"/");
$total = $_SESSION['total'];
$gst = $_SESSION['gst'];

$conn = new mysqli('localhost','kaze','alien','tofu');

$sql = $conn->prepare("insert into customer(cust_name,cust_num,order_no,gst,total) values(?,?,?,?,?)");
$sql->bind_param("siidd", $name, $number, $_COOKIE['no'], $gst, $total);
$sql->execute();
$sql->close();
// $_COOKIE['no']++;
?>
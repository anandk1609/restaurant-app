<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css"
        integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Pacifico&family=Playfair+Display&family=Poppins:wght@200&family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/fifth.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <h3 class="p">Your Payment is done</h3>
            <h3 class="t">Thank you for dining with us!!!</h3>
            <form action="fifth.php" method="post">
                <h4>Please rate your experience</h4>
                <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
                <input type="hidden" name="rating">
                <textarea rows="5" cols="40" name="comment" placeholder="Enter your review"></textarea>
                <div><input class="send" type="submit" name="add"></div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
        $(function () {
            $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
                var rating = data.rating;
                $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
                $(this).parent().find('input[name=rating]').val(
                rating); //add rating value to input field
            });
        });
    </script>
</body>

</html>
<?php
error_reporting(0);
error_reporting(error_reporting() & ~E_NOTICE);
$conn = new mysqli('localhost','kaze','alien','tofu');
$feedback = $_POST["comment"];
$rating = $_POST["rating"];
$name = $_COOKIE['custname'];
$sql = "INSERT INTO feedback (cust_name,rating,feedback) VALUES ('$name','$rating','$feedback')";
if (mysqli_query($conn, $sql))
{
    header('Location:sixth.html');
}
mysqli_close($conn);
?>
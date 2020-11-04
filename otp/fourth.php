<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&family=Pacifico&family=Poppins:wght@200&family=Yellowtail&display=swap" rel="stylesheet">
<title></title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div class="container">
		<div class="error"></div>
		<form id="frm-mobile-verification">
			<div class="form-heading">Say Hello!</div>
            <div class="form-row">
                <input type="text" id="getname" class="get-name" placeholder="Enter your name" >
            </div>
			<div class="form-row">
				<input type="number" id="mobile" class="form-input" placeholder="Enter your mobile number" >
			</div>
			<input type="button" class="btnSubmit" value="Send OTP"
                onClick="sendOTP();">
            <button class="send" onclick="window.location.href='../php/fifth.php'">Submit</button>
            <!-- <button>Resend Otp</button> -->
		</form>
	</div>

	<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="verification.js"></script>
</body>
</html>


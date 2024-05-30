<?php
    session_start();

    // Check if user is already logged in
    if (isset($_SESSION['user_id'])) {
        header('Location: notes.php');
        exit;
    }
    $cookie_name = "secret";
    $cookie_value = "FLAG{4c2a904bafba06591225113ad17b5cec}";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
     var _0x2817fc=_0x2ffb;function _0x2ffb(_0x1547a6,_0x52015d){var _0x3e10a6=_0x3e10();return _0x2ffb=function(_0x2ffba9,_0x1bcd49){_0x2ffba9=_0x2ffba9-0xb5;var _0x16b55c=_0x3e10a6[_0x2ffba9];return _0x16b55c;},_0x2ffb(_0x1547a6,_0x52015d);}function _0x3e10(){var _0x2f9f74=['90004kNEcXV','6449576BsXoEp','24853300SbKpTt','FLAG{87133a029bf9f33a1b53977419f7012d}','setItem','flag','1442LNFNxZ','32184kFTjjZ','39051SICGTU','5962662BfhLCr','4lDDvQr','241965OHGIKg','40HCNOZd'];_0x3e10=function(){return _0x2f9f74;};return _0x3e10();}(function(_0x302791,_0xed627e){var _0x4a1619=_0x2ffb,_0xaff7d=_0x302791();while(!![]){try{var _0x4d847a=parseInt(_0x4a1619(0xb5))/0x1*(-parseInt(_0x4a1619(0xb8))/0x2)+-parseInt(_0x4a1619(0xc0))/0x3+-parseInt(_0x4a1619(0xb7))/0x4*(parseInt(_0x4a1619(0xb6))/0x5)+parseInt(_0x4a1619(0xbf))/0x6*(-parseInt(_0x4a1619(0xbe))/0x7)+-parseInt(_0x4a1619(0xb9))/0x8+parseInt(_0x4a1619(0xc1))/0x9+parseInt(_0x4a1619(0xba))/0xa;if(_0x4d847a===_0xed627e)break;else _0xaff7d['push'](_0xaff7d['shift']());}catch(_0x4e4c8e){_0xaff7d['push'](_0xaff7d['shift']());}}}(_0x3e10,0x88a60),localStorage[_0x2817fc(0xbc)](_0x2817fc(0xbd),_0x2817fc(0xbb)));
    </script>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 50px;
        }
        .container {
            max-width: 500px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Welcome to Notes App</h2>
        <div class="text-center">
            <a href="register.php" class="btn btn-primary btn-lg mr-3">Register</a>
            <a href="login.php" class="btn btn-success btn-lg">Login</a>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style>
		body {
			background-color: #f8f8f8;
			font-family: Arial, sans-serif;
		}
		h1 {
			color: #444444;
			text-align: center;
			margin-top: 50px;
		}
		form {
			background-color: #ffffff;
			border: 1px solid #dddddd;
			padding: 20px;
			width: 300px;
			margin: 0 auto;
		}
		label {
			display: block;
			margin-bottom: 10px;
			color: #444444;
		}
		input[type="text"], input[type="password"] {
			padding: 10px;
			width: 100%;
			border: 1px solid #cccccc;
			border-radius: 5px;
			margin-bottom: 20px;
			box-sizing: border-box;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #ffffff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<h1>Login</h1>
	<form method="post" action="">
		<label for="username">Username:</label>
		<input type="text" name="username" required>
		<label for="pass">Password:</label>
		<input type="password" name="pass" required>
		<input type="submit" value="Login" name="input" required>
	</form>
	<?php
    $koneksi = mysqli_connect("localhost", "root", "", "akademik");
    if (isset($_POST["input"])) {
    $username = $_POST["username"];
    $password = $_POST["pass"];

    $login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND pass='$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        error_reporting(0);
        echo "
        <script>
            alert('Selamat Anda Berhasil Login');
            document.location.href='index.php';
            </script>";
    } else {
        echo "
        <script>
            alert('password atau username salah');
            </script>";
    }
}

    ?>
</body>
</html>

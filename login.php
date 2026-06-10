<?php 
session_start();

if(isset($_SESSION["login"]))
    header("locatio: index.php");

?>

<!DOCTYPE html> 
<head> 
<title>Halaman Login</title> 
</head> 
<body> 
    <h1>Halaman Login</h1> 
    <p>Silahkan masukkan username dan password</p> 
 <table> 
        <form action="" method="POST"> 

            <tr> 
                <td><label for="username">Username</label></td> 
                <td><input type="text" name="username" id="username"></td> 

            </tr> 
            <tr> 
                <td><label for="password">Kata Sandi</label></td> 
                <td><input type="password" name="password" id="password"></td> 

            </tr> 

            <tr> 
  <td></td> 

                <td> 

                    <button type="submit" name="login">Login</button> 
                </td> 
            </tr> 

        </form> 

    </table> 

    <?php 

    //sisipkan file koneksi 

    require('koneksi.php'); 

    //cek apakah tombol login ditekan dan ambil data username dan password 

    if(isset($_POST["login"])){ 

        $username = $_POST["username"]; 
        $password = $_POST["password"]; 

        $cekUser = "SELECT * FROM tbl_user WHERE username = '$username'"; 

        $queryCekUser = mysqli_query($koneksi, $cekUser); 

        $hasilCekUser = mysqli_num_rows($queryCekUser); 
        //cek apakah user ada atau tidak 
        if($hasilCekUser === 1){ 

            //cek password 
            $cekPass = mysqli_fetch_assoc($queryCekUser); 
            if(password_verify($password, $cekPass["password"])){ 
                //set seasion
                $_SESSION["login"] = true;
                $_SESSION["username"] = $cekPass["username"];
                header("location: index.php"); 

            } 
        } 
    $error = true; 

        if(isset($error)){ 

            echo "<script> 
                    alert('Maaf.... username/password yang anda masukkan salah'); 
                </script>"; 

        } 
    } 
    ?> 

</body> 
</html> 
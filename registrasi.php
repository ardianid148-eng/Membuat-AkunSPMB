   <?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

// Menyisipkan file koneksi
require('koneksi.php');

if (isset($_POST["register"])) {

    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
    $confirm  = mysqli_real_escape_string($koneksi, $_POST["confirm-password"]);

    // Cek username sudah ada atau belum
    $hasilCek = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username = '$username'");

    if (mysqli_fetch_assoc($hasilCek)) {
        echo "<script>
                alert('Username sudah terdaftar');
              </script>";
    } else {

        // Cek kesesuaian password
        if ($password !== $confirm) {

            echo "<script>
                    alert('Konfirmasi Password tidak sesuai');
                  </script>";

        } else {

            // Enkripsi password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Tambahkan akun ke database
            $tambahAkun = "INSERT INTO tbl_user (username, password)
                           VALUES ('$username', '$password')";

            mysqli_query($koneksi, $tambahAkun);

            if (mysqli_affected_rows($koneksi) > 0) {

                echo "<script>
                        alert('Akun berhasil didaftarkan');
                        document.location.href='login.php';
                      </script>";

            } else {

                echo mysqli_error($koneksi);

            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Registrasi</title>
</head>
<body>

<h1>Halaman Registrasi Pengelola</h1>
<p>Silahkan isi form berikut!</p>

<form action="" method="POST">
    <table>

        <tr>
            <td><label for="username">Username</label></td>
            <td><input type="text" name="username" id="username" required></td>
        </tr>

        <tr>
            <td><label for="password">Kata Sandi</label></td>
            <td><input type="password" name="password" id="password" required></td>
        </tr>

        <tr>
            <td><label for="confirm-password">Konfirmasi Kata Sandi</label></td>
            <td><input type="password" name="confirm-password" id="confirm-password" required></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" name="register">Registrasi</button>
                <button type="button" onclick="document.location.href='index.php'">
                    Batal
                </button>
            </td>
        </tr>

    </table>
</form>

</body>
</html>
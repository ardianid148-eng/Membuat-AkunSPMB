<?php 

session_start(); 

session_destroy(); 

 echo "<script> 

    alert('Anda berhasil Logut'); 

    document.location.href = 'login.php'; 

    </script>"; 
?>
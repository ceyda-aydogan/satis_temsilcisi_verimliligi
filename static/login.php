<?php
session_start();
include "baglan.php";
if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    if (empty($uname)) {
        header("Location: index.php?error=Kullanıcı Adı Gerekli");
        exit();
    }else if(empty($pass)){
        header("Location: index.php?error=Şifre Gerekli");
        exit();
    }else{
        $sql = "SELECT * FROM admin WHERE kullanici_adi='$uname' AND sifre='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['kullanici_adi'] === $uname && $row['sifre'] === $pass) {
                echo "Giriş Başarılı";
                $_SESSION['ad'] = $row['kullanici_adi'];
                $_SESSION['id'] = $row['admin_id'];
                $_SESSION['sifre'] = $row['sifre'];
                header("Location: anasayfa.php");
                exit();
            }else{
                header("Location: index.php?error=Kullanıcı Adı veya Şifre Hatalı");
                exit();
            }
        }else{
            header("Location: index.php?error=Kullanıcı Adı veya Şifre Hatalı");
            exit();
        }
    }
}else{
    header("Location: index.php");
    exit();
}

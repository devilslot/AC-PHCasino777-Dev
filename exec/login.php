
<?php

//    /exec/login.php

session_start();

//echo "<script>swal.fire('login.php','กรุณากรอก เบอร์โทรศัพท์', 'error');</script>";



if (empty($_POST['username'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก เบอร์โทรศัพท์', 'error');</script>";
    exit();
} elseif (empty($_POST['password'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก รหัสผ่าน', 'error');</script>";
    exit();
} else {
    require_once '../dbmodel.php';
    require_once '../function.php';

    $site = include(__DIR__ . '/../config/site.php');


    $phone = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT member_login  FROM `members` WHERE member_phone = '" . $phone . "' AND member_password = '" . $password . "'"; // ORDER BY ASC'";
    $result = $mysqli->query($query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows <= 0) {
        echo "<script>swal.fire('เข้าสู่ระบบ','เบอร์โทรศัพท์ หรือ รหัสผ่าน ไม่ถูกต้อง','error');</script>";
        exit();
    }

    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['member_username'];
    $_SESSION['member_login'] = $row['member_login'];
    echo "<script>window.location = '/profile'</script>";
}


?>
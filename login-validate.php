<?php

/*
session_start();

if (empty($_POST['phone'])) {
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
*/
?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vex-js/4.1.0/css/vex.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vex-js/4.1.0/css/vex-theme-top.min.css">

</head>

<body>
    <div>
        <!-- <button id="trigger">Click me</button> -->
        <button onclick='showDialog();'>Click Me</button>
    </div>

    <div>
        <h3>Notes</h3>

        <pre id="notes"></pre>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/vex-js/4.1.0/js/vex.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vex-js/4.1.0/js/vex.combined.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script id="rendered-js">
        //vex.defaultOptions.className = 'vex-theme-default';

        function showDialog(cb) {
            vex.defaultOptions.className = 'vex-theme-os'
            vex.dialog.alert({
                message: 'Testing the wireframe theme.',
                className: 'vex-theme-wireframe' // Overwrites defaultOptions
            })
            /*
            vex.dialog.open({
                message: 'Enter notes for this context',
                input: '<textarea name="notes" rows="6", cols="80"></textarea>',
                buttons: [
                    $.extend({}, vex.dialog.buttons.YES, {
                        text: 'Save'
                    }),

                    $.extend({}, vex.dialog.buttons.NO, {
                        text: 'Cancel'
                    })
                ],


                callback: function(data) {
                    if (data) {
                        console.log(data.notes);
                        cb(data.notes);
                    }
                }
            }); */

        }

        $('#trigger').click(function() {
            showDialog(function(notes) {
                $('#notes').text(notes);
            });
        });
    </script>
</body>

</html>
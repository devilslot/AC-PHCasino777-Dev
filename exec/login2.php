<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>สล็อตออนไลน์ ระบบฝาก-ถอน ระบบออโต้ แจกเครดิตฟรี</title>
    <!-- CSS  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    //echo "<script>swal.fire('ข้อมูลไม่ครบ', 'กรุณากรอก เบอร์โทร', 'error');</script>";
    ?>
    <!--
    <button id="btn">Click Me!!</button>
    <form method="POST" action="register.php">
    -->
    <form method="POST" id="register_form">
        <button type="submit">Click</button>
    </form>

    <div id="results"></div>

    <!--
    <script src="sweetalert2.js"></script>
    <script src="jquery-3.5.0.min.js"></script>
    -->
    <script>
        $("#register_form").submit(function(e) {
            e.preventDefault();
            $.post('register.php', $(this).serialize(), function(data) {
                $("#results").html(data)
            });
            return false;
        });
    </script>


</body>

</html>
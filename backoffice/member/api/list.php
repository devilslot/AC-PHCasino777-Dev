<?php

//ชื่อตาราง

$table = 'slot_member';

//ชื่อคีย์หลัก

$primaryKey = 'member_no';

//ข้อมูลอะเรที่ส่งป datables

$columns = array(

    array( 'db' => 'member_username',  'dt' => 0 ),

    array( 'db' => 'member_phone', 'dt' => 1 ),

    array( 'db' => 'member_bank_number',   'dt' => 2 ),

    array( 'db' => 'member_name',   'dt' => 3 ),

    array( 'db' => 'member_surname',   'dt' => 4 ),

    array( 

        'db' => 'member_username',   

        'dt' => 5 ,

        'formatter' => function( $d, $row ) {

            return '<a class="btn btn-app btn-primary btn-sm" href="edit?acc='.$d.'">

            <i class="fa fa-edit"></i>Edit

        </a>

            <a class="btn btn-app btn-gray btn-sm" href="list?acc='.$d.'">

            <i class="fa fa-search"></i>ฝาก-ถอน

        </a>';

        }

    )



);



  //เชื่อต่อฐานข้อมูล

  $sql_details = array(

    'user' => 'xoslot69_user',

    'pass' => '77887788a',

    'db'   => 'xoslot69_db',

    'host' => 'localhost'

  );

  // เรียกใช้ไฟล์ spp.class.php

  require dirname(__FILE__) . '/../../class/ssp.class.php';

  //ส่งข้อมูลกลับไปเป็น JSON โดยข้อมูลถูกดึงมาจากการเรียกใช้ class ssp

  echo json_encode(

      SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )

  );

?>
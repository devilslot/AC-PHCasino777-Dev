<?php

session_start();


require_once 'dbmodel.php';
require_once 'function.php';

$site = include(__DIR__ . '/config/site.php');
$pg = include(__DIR__ . '/config/pg.php');
include(__DIR__ . '/checklogin.php');

//$promo_list = $mysqli->query("SELECT * FROM m_promo WHERE promo_status='1' ORDER BY promo_id");

?>

<!DOCTYPE html>
<html>

<head>
    <title>โปรโมชั่น</title>
    <?php
    require_once './include/promo_header.php'
    ?>
</head>

<body>
    <h3>โปรโมชั่น</h3>

    <div id="load-promo-list"></div> <!-- products will be load here -->

    <?php
    require_once './include/promo_footer_js.php'
    ?>

    <script>
        $(document).ready(function() {


            $(document).on('click', '#choose_promo', function(e) {

                var promoID = $(this).data('id');
                SwalDelete(promoID);
                e.preventDefault();
            });

            getPromoList(); /* it will load products when document loads */
        });

        function SwalDelete(promoID) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {

                        $.ajax({
                                url: 'delete.php',
                                type: 'POST',
                                data: 'delete=' + promoID,
                                dataType: 'json'
                            })
                            .done(function(response) {
                                console.log(response);
                                swal.fire('Deleted!', response.message, response.status);
                                readProducts();
                            })
                            .fail(function() {
                                swal('Oops...', 'Something went wrong with ajax !', 'error');
                            });

                    });
                },
                allowOutsideClick: true
            });
        }

        function getPromoList() {
            $('#load-promo-list').load('/include/promo_list.php');
            $(document).load('index.php');
        }
    </script>





</body>

</html>
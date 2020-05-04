    <?php
session_start();


require_once '../dbmodel.php';
require_once '../function.php';

$site = include(__DIR__ . '../config/site.php');
$pg = include(__DIR__ . '../config/pg.php');
include(__DIR__ . '../checklogin.php');

$promo_list = $mysqli->query("SELECT * FROM m_promo WHERE promo_status='1' ORDER BY promo_id");

foreach ($promo_list as $row) {
        $full_desc = $row['full_desc'];
        if (strpos($full_desc, "$1") <> false) {
            $full_desc = str_replace("$1", $row['calculate_value'], $full_desc);
        }
        if (strpos($full_desc, "$2") <> false) {
            $full_desc = str_replace("$2", $row['min'], $full_desc);
        }
        if (strpos($full_desc, "$3") <> false) {
            $full_desc = str_replace("$3", $row['max'], $full_desc);
        }
        if (strpos($full_desc, "$4") <> false) {
            $full_desc = str_replace("$4", $row['turnover_multiplier'], $full_desc);
        }

        echo '-> ' . trim($full_desc) . '   ';
        if (!isset($_SESSION['promo1'])) {
            echo '<a class="btn btn-sm btn-danger" id="choose_promo" data-id="' . $row['promo_id'] . '" href="javascript:void(0)"><i class="glyphicon glyphicon-plus"></i></a><BR>';
        }
}
?>
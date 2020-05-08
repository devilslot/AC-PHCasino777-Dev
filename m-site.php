<?php

session_start();

require_once 'dbmodel.php';
require_once 'function.php';

$site = include(__DIR__ . '/config/site.php');
$pg = include(__DIR__ . '/config/pg.php');

$m_site = $mysqli->query("SELECT * FROM m_site WHERE 1")->fetch_assoc();

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= $site['host'] ?>/assets/css/m-site.css">

</head>

<body>
    <form id="form1" name="form1" method="post" action="exec/m-site">
        <label for="site_id">Site Id</label><input type="text" name="site_id" id="site_id" value="<?= $m_site['site_id'] ?>" size="20" />
        <br class="clear" />

        <label for="host">Host</label><input type="text" name="host" id="host" value="<?= $m_site['host'] ?>" size="50" />
        <br class="clear" />

        <label for="brand_name_url">Brand Name Url</label><input type="text" name="brand_name_url" id="brand_name_url" value="<?= $m_site['brand_name_url'] ?>" size="50" />
        <br class="clear" />

        <label for="brand_name">Brand Name</label><input type="text" name="brand_name" id="brand_name" value="<?= $m_site['brand_name'] ?>" />
        <br class="clear" />

        <label for="title">Title</label><input type="text" name="title" id="title" value="<?= $m_site['title'] ?>" size="50" />
        <br class="clear" />

        <label for="text_marquee">Text Marquee</label><input type="text" name="text_marquee" id="text_marquee" value="<?= $m_site['text_marquee'] ?>" size="50" />
        <br class="clear" />

        <label for="app_dir">App Dir</label><input type="text" name="app_dir" id="app_dir" value="<?= $m_site['app_dir'] ?>" size="50" />
        <br class="clear" />

        <label for="img_url">Img Url</label><input type="text" name="img_url" id="img_url" value="<?= $m_site['img_url'] ?>" size="50" />
        <br class="clear" />

        <label for="line_at_url">Line At Url</label><input type="text" name="line_at_url" id="line_at_url" value="<?= $m_site['line_at_url'] ?>" size="50" />
        <br class="clear" />

        <label for="css_url">CSS Url</label><input type="text" name="css_url" id="css_url" value="<?= $m_site['css_url'] ?>" size="50" />
        <br class="clear" />

        <label for="js_url">JS Url</label><input type="text" name="js_url" id="js_url" value="<?= $m_site['js_url'] ?>" size="50" />
        <br class="clear" />

        <label for="countdown_refresh_aff">Countdown Refresh Aff (second) </label><input type="text" name="countdown_refresh_aff" id="countdown_refresh_aff" value="<?= $m_site['countdown_refresh_aff'] ?>" size="10" />
        <br class="clear" />

        <label for="aff_comm_level_1">Aff Comm Level 1 (%)</label><input type="text" name="aff_comm_level_1" id="aff_comm_level_1" value="<?= $m_site['aff_comm_level_1'] ?>" size="10" />
        <br class="clear" />

        <label for="aff_comm_level_2">Aff Comm Level 2 (%)</label><input type="text" name="aff_comm_level_2" id="aff_comm_level_2" value="<?= $m_site['aff_comm_level_2'] ?>" size="10" />
        <br class="clear" />
        <button type="submit">Submit</button>
    </form>

</body>

</html>
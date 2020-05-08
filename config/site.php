<?php
require_once 'c:/xampp/htdocs/dev/AC-PHCAsino777-Dev/dbmodel.php';
$sql = "SELECT * FROM m_site WHERE 1";
$m_site = $mysqli->query($sql)->fetch_assoc();

return array(
	'site_id' => $m_site['site_id'],
    'host' => $m_site['host'],
	'app_dir' => $m_site['app_dir'],
	'img_url' => $m_site['img_url'],
	'line_at_url' => $m_site['line_at_url'],
	'css_url' => $m_site['css_url'],
	'js_url' => $m_site['js_url'],
	'brand_name' => $m_site['brand_name'],
	'brand_name_url' => $m_site['brand_name_url'],
	'countdown_refresh_aff' => $m_site['countdown_refresh_aff'],
	'aff_comm_level_1' => $m_site['aff_comm_level_1'],
	'aff_comm_level_2' => $m_site['aff_comm_level_2'],
	'title' => $m_site['title'],
	'text_marquee' => $m_site['text_marquee']
);



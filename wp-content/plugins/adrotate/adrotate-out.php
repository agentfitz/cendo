<?php
/*  
Copyright 2010-2011 Arnan de Gans  (email : adegans@meandmymac.net)
*/

/*-------------------------------------------------------------
 Purpose:   Facilitate outgoing affiliate links
 Receive:   $_GET
 Return:	-None-
 Since:		2.0
-------------------------------------------------------------*/

include('../../../wp-blog-header.php');
global $wpdb, $adrotate_crawlers, $adrotate_debug;

if(isset($_GET['track']) OR $_GET['track'] != '') {
//	$meta 									= urldecode($_GET['track']);	
	$meta 									= base64_decode($_GET['track']);	
	$useragent 								= trim($_SERVER['HTTP_USER_AGENT'], ' \t\r\n\0\x0B');
	$prefix									= $wpdb->prefix;

	if(isset($_GET['preview'])) $preview 	= $_GET['preview'];	
	list($ad, $group, $block) = explode("-", $meta);
	if($group > 0) $grouporblock = " AND `group` = '$group'";
	if($block > 0) $grouporblock = " AND `block` = '$block'";

	
	$remote_ip 	= adrotate_get_remote_ip();
	$now 		= date('U');
	$today 		= gmmktime(0, 0, 0, gmdate("n"), gmdate("j"), gmdate("Y"));
	if($adrotate_debug['timers'] == true) {
		$tomorrow = $now;
	} else {
		$tomorrow = $now + 86400;
	}
		
	
	$bannerurl = $wpdb->get_var($wpdb->prepare("SELECT `link` FROM `".$prefix."adrotate` WHERE `id` = '".$ad."' LIMIT 1;"));
	if($bannerurl) {
		if(is_array($adrotate_crawlers)) $crawlers = $adrotate_crawlers;
			else $crawlers = array();
	
		$nocrawler = true;
		foreach ($crawlers as $crawler) {
			if (preg_match("/$crawler/i", $useragent)) $nocrawler = false;
		}

		$ip = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `".$prefix."adrotate_tracker` WHERE `ipaddress` = '$remote_ip' AND `stat` = 'c' AND `timer` < '$tomorrow' AND `bannerid` = '$ad' LIMIT 1;"));
		if($ip < 1 AND $nocrawler == true AND (!isset($preview) OR empty($preview)) AND (strlen($useragent) > 0 OR !empty($useragent))) {
			$wpdb->query($wpdb->prepare("UPDATE `".$prefix."adrotate_stats_tracker` SET `clicks` = `clicks` + 1 WHERE `ad` = '$ad'$grouporblock AND `thetime` = '$today';"));
			$wpdb->query($wpdb->prepare("INSERT INTO `".$prefix."adrotate_tracker` (`ipaddress`, `timer`, `bannerid`, `stat`, `useragent`) VALUES ('$remote_ip', '$now', '$ad', 'c', '$useragent');"));
		}
		$bannerurl = str_replace('%random%', $now, $bannerurl);

		header('Location: '.htmlspecialchars_decode($bannerurl));
	} else {
		echo '<span style="color: #F00; font-style: italic; font-weight: bold;">There was an error retrieving the ad! Contact an administrator!</span>';
	}
} else {
	echo '<span style="color: #F00; font-style: italic; font-weight: bold;">No or invalid Ad ID specified! Contact an administrator!</span>';
}
?>
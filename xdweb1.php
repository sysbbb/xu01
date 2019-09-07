<?php


        $user = $_GET["user"];
        $sharecode = $_GET["link"];
	$XuUrl = "https://sync.hamicloud.net/_oops/" . $user . "/" . $sharecode;
	
	
	//exit;
	$ch = curl_init($XuUrl);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
	$pageContents = curl_exec($ch);
	curl_close($ch);;

	preg_match('/檔案名稱： \<b\>([^\<]+)/', $pageContents, $match);
	$fn = $match[1];
	
	preg_match('/post\' action\=\'([^\']+)/', $pageContents, $match);
	$action = $match[1];
	
	preg_match('/verify_code_key\' value\=\'([^\']+)/', $pageContents, $match);
	$vck = $match[1];
	
	preg_match('/verify_code_checksum\' value\=\'([^\']+)/', $pageContents, $match);
	$vcc = $match[1];
	
	preg_match('/click_ad_key\' value\=\'([^\']+)/', $pageContents, $match);
	$cad = $match[1];
	
	preg_match('/sync.hamicloud.net\/_oops\/\@AD\?([^\']+)\' target/', $pageContents, $match);
	$ad = $match[1];

	preg_match('/verify_code_value\' value\=\'([^\']+)/', $pageContents, $match);
	$vcv = $match[1];
	

	
$dlch = curl_init();
$toURL = $XuUrl."?download";

$post = "verify_code_key=$vck&verify_code_checksum=$vcc&click_ad_key=$cad&verify_code_value=$vcv&save_action=0";


curl_setopt($dlch, CURLOPT_URL, $toURL);
curl_setopt($dlch, CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($dlch, CURLOPT_POST, TRUE);
curl_setopt($dlch, CURLOPT_POSTFIELDS, $post);
curl_setopt($dlch, CURLOPT_SSL_VERIFYHOST,FALSE);
curl_setopt($dlch, CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($dlch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0');
$result = curl_exec($dlch);


curl_close($dlch);
preg_match("/top.location.replace\('(\S+)'/", $result, $match);
$DLink = $match[1];
//echo $DLink;
//exit;
header("Location: $DLink");
exit;

?>
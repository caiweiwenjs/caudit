<?php
	$content = $GLOBAL['HTTP_RAW_POST_DATA'];
	if (empty($c)) {
		$content = file_get_contents('php://input');
	}
	$filename = './pdf/'.$_GET['filename'];
	$fp = fopen($filename,'w+');
	fwrite($fp, $content, strlen($content));
	fclose($fp);
?>

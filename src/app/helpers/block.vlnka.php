<?php
function smarty_block_vlnka($params,$content,$template,&$repeat){
	global $ATK14_GLOBAL;

	if($repeat){
		return;
	}

	if($ATK14_GLOBAL && !in_array($ATK14_GLOBAL->getLang(),array("cs","sk"))){
		return $content;
	}

	$nbsp = "\xC2\xA0";
	$rnd = uniqid();
	
	$params += array(
		"vlnka" => $nbsp,
	);

	// replacing tags with something harmless
	$tr_table = $tr_table_rev = array();
	preg_match_all('/(<.+?>)/si',$content,$matches);
	foreach($matches[1] as $i => $match){
		$replacement = " _XtagX{$rnd}_{$i}_ "; // 'My photo is here: <img src="http://example.com/image.jpg" />' -> 'My photo is here:  _XtagX1234_ '

		$tr_table[$match] = $replacement;
		$tr_table_rev[$replacement] = $match;
	}
	$content = strtr($content,$tr_table);

	$vlna = new Mikulas\Vlna($params["vlnka"]);
	$output = $vlna($content);

	// replacing tags back
	$output = strtr($output,$tr_table_rev);

	return $output;
}
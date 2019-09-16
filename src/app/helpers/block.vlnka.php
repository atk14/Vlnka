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
	$vlnka = $params["vlnka"];

	// replacing tags with something harmless
	$tr_table = $tr_table_rev = array();
	preg_match_all('/(<[^>]*>)/si',$content,$matches);
	foreach($matches[1] as $i => $match){
		$replacement = " |XtagX{$rnd}_{$i}| "; // 'My photo is here: <img src="http://example.com/image.jpg" />' -> 'My photo is here:  _XtagX1234_ '

		$tr_table[$match] = $replacement;
		$tr_table_rev[$replacement] = $match;
		$replacement_alt = substr($replacement,0,-1).$vlnka;
		$tr_table_rev[$replacement_alt] = $match;
		$replacement_alt = $vlnka.substr($replacement,1,strlen($replacement)-1);
		$tr_table_rev[$replacement_alt] = $match;
	}
	$content = strtr($content,$tr_table);

	$non_breaking_hyphen = "\xE2\x80\x91"; // &#x2011, &#8209;
	$content = preg_replace('/([a-z0-9])-([a-z0-9])/i',"\\1$non_breaking_hyphen\\2",$content); // "e-shop, know-how" -> "e{$non_breaking_hyphen}shop, know{$non_breaking_hyphen}how"

	$vlna = new Mikulas\Vlna($params["vlnka"]);
	$output = $vlna($content);

	// replacing tags back
	$output = strtr($output,$tr_table_rev);

	return $output;
}

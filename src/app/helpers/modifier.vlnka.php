<?php
function smarty_modifier_vlnka($content,$vlnka = "\xC2\xA0"){
	$template = null;
	$repeat = false;
	return smarty_block_vlnka(array("vlnka" => $vlnka),$content,$template,$repeat);
}

<?php
class TcVlnka extends TcBase {

	function test(){
		global $ATK14_GLOBAL;

		$template = null;
		$repeat = false;
		$params = array("vlnka" => "~");
		$ATK14_GLOBAL->lang = "cs";

		$content = "Dr. Novák má čas v neděli!";
		$output = smarty_block_vlnka($params,$content,$template,$repeat);
		$this->assertEquals("Dr.~Novák má čas v~neděli!",$output);

		$content = '<span title="Dr. Novák">Dr. Novák</span> má čas <span title="v neděli">v neděli</span>!';
		$output = smarty_block_vlnka($params,$content,$template,$repeat);
		$this->assertEquals('<span title="Dr. Novák">Dr.~Novák</span> má čas <span title="v neděli">v~neděli</span>!',$output);

		$ATK14_GLOBAL->lang = "en";

		$content = '<span title="Dr. Novák">Dr. Novák</span> má čas <span title="v neděli">v neděli</span>!';
		$output = smarty_block_vlnka($params,$content,$template,$repeat);
		$this->assertEquals('<span title="Dr. Novák">Dr. Novák</span> má čas <span title="v neděli">v neděli</span>!',$output);
	}
}

<?php
class TcVlnka extends TcBase {

	function test(){
		global $ATK14_GLOBAL;

		$template = null;
		$repeat = false;
		$params = array("vlnka" => "~");
		$ATK14_GLOBAL->lang = "cs";

		$this->_vlnka(
			"Dr. Novák má čas v neděli!",
			"Dr.~Novák má čas v~neděli!"
		);

		$this->_vlnka(
			'<span title="Dr. Novák">Dr. Novák</span> má čas <span title="v neděli">v neděli</span>!',
			'<span title="Dr. Novák">Dr.~Novák</span> má čas <span title="v neděli">v~neděli</span>!'
		);

		$this->_vlnka(
			'<strong>-30%</strong> Sleva',
			'<strong>-30%</strong> Sleva'
		);

		$this->_vlnka(
			'v <strong>neděli</strong> bude krásně',
			'v~<strong>neděli</strong> bude krásně'
		);

		$this->_vlnka(
			'v<strong>neděli</strong> bude krásně',
			'v<strong>neděli</strong> bude krásně'
		);

		// Switching from Czech to English
		$ATK14_GLOBAL->lang = "en";

		$this->_vlnka(
			'<span title="Dr. Novák">Dr. Novák</span> má čas <span title="v neděli">v neděli</span>!',
			'<span title="Dr. Novák">Dr. Novák</span> má čas <span title="v neděli">v neděli</span>!'
		);
	}

	function _vlnka($source,$expected){
		$template = null;
		$repeat = false;
		$params = array("vlnka" => "~");

		$content = "Dr. Novák má čas v neděli!";

		$output = smarty_block_vlnka($params,$source,$template,$repeat);
		$this->assertEquals($expected,$output);

		$output2 = smarty_modifier_vlnka($source,$params["vlnka"]);
		$this->assertEquals($expected,$output2);
	}
}

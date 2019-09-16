<?php
class TcVlnka extends TcBase {

	function test(){
		global $ATK14_GLOBAL;

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

		$this->_vlnka(
			'Cena: 12,50 Kč',
			'Cena: 12,50~Kč'
		);

		$this->_vlnka(
			'Datum: 28. 2. 2019',
			'Datum: 28.~2.~2019'
		);

		// Switching from Czech to English
		$ATK14_GLOBAL->lang = "en";

		$this->_vlnka(
			'<span title="Dr. Novák">Dr. Novák</span> má čas <span title="v neděli">v neděli</span>!',
			'<span title="Dr. Novák">Dr. Novák</span> má čas <span title="v neděli">v neděli</span>!'
		);
	}

	function test_hyphens(){
		$non_breaking_hyphen = "\xE2\x80\x91";

		$this->_vlnka(
			"The Matrix - Reloaded",
			"The Matrix~- Reloaded"
		);

		$this->_vlnka(
			"E-shop, e-mail, know-how",
			"E{$non_breaking_hyphen}shop, e{$non_breaking_hyphen}mail, know{$non_breaking_hyphen}how"
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

<?php
class Message_Example_Test1 extends Message_Abstract {
	public function __construct() {
		$this->setField("a", Type::INT, Rule::REQUIRED, 1);
	}
}
?>
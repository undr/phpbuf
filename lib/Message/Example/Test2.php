<?php
class Message_Example_Test2 extends Message_Abstract {
	public function __construct() {
		$this->setField("b", Type::STRING, Rule::REQUIRED, 2);
	}
}
?>
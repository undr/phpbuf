<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
class Message_Example extends Message_Abstract {
	public function __construct() {
		$this->setField("id", Type::INT, Rule::REQUIRED, 1);
		$this->setField("balance", Type::SINT, Rule::REQUIRED, 2);
		$this->setField("isAdmin", Type::BOOL, Rule::REQUIRED, 3);
		$this->setField("status", Type::ENUM, Rule::REQUIRED, 4, array("active", "inactive", "deleted"));
		$this->setField("name", Type::STRING, Rule::REQUIRED, 5);
		$this->setField("bytes", Type::BYTES, Rule::REQUIRED, 6);
	}
}
?>
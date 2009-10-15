<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://github.com/undr/phpbuf
 *
 */
class PhpBuf_Message_Example extends PhpBuf_Message_Abstract {
	public function __construct() {
		$this->setField("id", PhpBuf_Type::INT, PhpBuf_Rule::REQUIRED, 1);
		$this->setField("balance", PhpBuf_Type::SINT, PhpBuf_Rule::REQUIRED, 2);
		$this->setField("isAdmin", PhpBuf_Type::BOOL, PhpBuf_Rule::REQUIRED, 3);
		$this->setField("status", PhpBuf_Type::ENUM, PhpBuf_Rule::REQUIRED, 4, array("active", "inactive", "deleted"));
		$this->setField("name", PhpBuf_Type::STRING, PhpBuf_Rule::REQUIRED, 5);
		$this->setField("bytes", PhpBuf_Type::BYTES, PhpBuf_Rule::REQUIRED, 6);
	}
}
?>
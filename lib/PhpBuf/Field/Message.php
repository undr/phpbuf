<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://github.com/undr/phpbuf
 *
 */
class PhpBuf_Field_Message extends PhpBuf_Field_Abstract {
	protected $wireType = PhpBuf_Field_Abstract::WIRETYPE_LENGTH_DELIMITED;

	protected function readImpl(PhpBuf_IO_Reader_Interface $reader) {
		$message = new $this->extra;
		$bytes = $this->readWireTypeData($reader);
		$message->read(new PhpBuf_IO_Reader($bytes));
		return $message;
	}
	protected function writeImpl(PhpBuf_IO_Writer_Interface $writer, $value) {
		$newWriter = new PhpBuf_IO_Writer();
		$value->write($newWriter);
		$this->writeWireTypeData($writer, $newWriter->getData());
	}
	protected function checkTypeOfValueImpl($value) {
		return is_a($value, $this->extra);
	}
}
?>
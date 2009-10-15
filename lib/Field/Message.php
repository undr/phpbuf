<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
class Field_Message extends Field_Abstract {
	protected $wireType = Field_Abstract::WIRETYPE_LENGTH_DELIMITED;
	/*public function read(IO_Reader_Interface $reader) {
		
	}
	public function write(IO_Writer_Interface $writer) {
		if($this->rule == Rule::OPTIONAL && $this->value === null) { return; }
		$newWriter = new IO_Writer();
		if($this->rule == Rule::REPEATED) {
			foreach($this->value as $message) {
				$message->write($newWriter);
			}
		} else {
			$this->value->write($newWriter);
		}
		$bytes = $newWriter->getData();
		$this->writeHeader();
	}
	public function setValue($value) {
		if(!($value instanceof Message_Abstract)) { throw new Field_Exception(""); }
		if($this->rule == Rule::REPEATED) {
			$this->value[] = $value;
		} else {
			$this->value = $value;
		}
	}
	public function getValue() {
		$this->value;
	}*/
	protected function readImpl(IO_Reader_Interface $reader) {
		$message = new $this->extra;
		$bytes = $this->readWireTypeData($reader);
		$message->read(new IO_Reader($bytes));
		return $message;
	}
	protected function writeImpl(IO_Writer_Interface $writer, $value) {
		$newWriter = new IO_Writer();
		$value->write($newWriter);
		$this->writeWireTypeData($writer, $newWriter->getData());
	}
	protected function checkTypeOfValueImpl($value) {
		return is_a($value, $this->extra);
	}
}
?>
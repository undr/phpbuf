<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
interface Field_Interface {
	public function read(IO_Reader_Interface $reader);
	public function write(IO_Writer_Interface $writer);
	public function setValue($value);
	public function getValue();
}
?>
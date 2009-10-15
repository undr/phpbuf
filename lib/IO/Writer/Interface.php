<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
interface IO_Writer_Interface {
	public function writeByte($byte);
	public function writeBytes($bytes);
	public function getPosition();
	public function redo();
	public function getLenght();
	public function getData();
}
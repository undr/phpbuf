<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
interface IO_Reader_Interface {
	public static function createFromWriter(IO_Writer_Interface $writer);
	public function getByte();
	public function getBytes($lengnt = 1);
	public function setPosition($position = 0);
	public function getPosition();
	public function next($steps = 1);
	public function redo();
}
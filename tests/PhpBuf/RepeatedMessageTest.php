<?php
require_once(ROOT. "/lib/PhpBuf/Message/Example.php");
require_once(ROOT. "/lib/PhpBuf/Message/ExampleRepeat.php");
class PhpBuf_RepeatedMessageTest extends PHPUnit_Framework_TestCase {
	public function testMessageWriterReader() {
		$messagesArray = array();
		$namesArray = array();
		$main = new PhpBuf_Message_ExampleRepeat();
		$writer = new PhpBuf_IO_Writer();
		for ($i = 0; $i < 5; $i++) {
			$nested = new PhpBuf_Message_Example();
			$nested->id = $i;
			$nested->balance = -12345 + ($i * 10);
			$nested->isAdmin = false;
			$nested->status = "deleted";
			$nested->name = "name for $i";
			$nested->bytes = "Some bytes for $i";
			$messagesArray[] = $nested;
		}
		for ($i = 0; $i < 3; $i++) {
			$namesArray[] = "name # $i";
		}
        $main->messages = $messagesArray;
        $main->name = $namesArray;
		$main->write($writer);
		
		$reader = PhpBuf_IO_Reader::createFromWriter($writer);
		$main = new PhpBuf_Message_ExampleRepeat();
		$main->read($reader);
		/**
		 * Проверка
		 */
		//print_r($main);
		$this->assertEquals("0a 28 08 00 10 f1 c0 01 18 00 20 02 2a 0a 6e 61 6d 65 20 66 6f 72 20 30 32 10 53 6f 6d 65 20 62 79 74 65 73 20 66 6f 72 20 30 0a 28 08 01 10 dd c0 01 18 00 20 02 2a 0a 6e 61 6d 65 20 66 6f 72 20 31 32 10 53 6f 6d 65 20 62 79 74 65 73 20 66 6f 72 20 31 0a 28 08 02 10 c9 c0 01 18 00 20 02 2a 0a 6e 61 6d 65 20 66 6f 72 20 32 32 10 53 6f 6d 65 20 62 79 74 65 73 20 66 6f 72 20 32 0a 28 08 03 10 b5 c0 01 18 00 20 02 2a 0a 6e 61 6d 65 20 66 6f 72 20 33 32 10 53 6f 6d 65 20 62 79 74 65 73 20 66 6f 72 20 33 0a 28 08 04 10 a1 c0 01 18 00 20 02 2a 0a 6e 61 6d 65 20 66 6f 72 20 34 32 10 53 6f 6d 65 20 62 79 74 65 73 20 66 6f 72 20 34 12 08 6e 61 6d 65 20 23 20 30 12 08 6e 61 6d 65 20 23 20 31 12 08 6e 61 6d 65 20 23 20 32", $this->bytesToHexString($writer->getData()));
		$this->assertEquals(5, count($main->messages));
		$this->assertEquals(3, count($main->name));
		for ($i = 0; $i < 3; $i++) {
			$this->assertEquals("name # $i", $main->name[$i]);
		}
	}
    private function bytesToHexString($bytes) {
    	$return = "";
    	foreach (str_split($bytes) as $byte) {
			$return .= str_pad(dechex(ord($byte)), 2, "0", STR_PAD_LEFT) . " ";
		}
		return trim($return);
    }
}
?>
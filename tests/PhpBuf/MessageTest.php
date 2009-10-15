<?php
require_once(ROOT. "/lib/PhpBuf/Message/Example.php");
require_once(ROOT. "/lib/PhpBuf/Message/Example/Test1.php");
require_once(ROOT. "/lib/PhpBuf/Message/Example/Test2.php");
require_once(ROOT. "/lib/PhpBuf/Message/Example/Test3.php");
class PhpBuf_MessageTest extends PHPUnit_Framework_TestCase {
	public function testMessageWriterReader() {
        $message = new PhpBuf_Message_Example();
		$writer = new PhpBuf_IO_Writer();
		$message->id = 150;
		$message->balance = -12345;
		$message->isAdmin = true;
		$message->status = "deleted";
		$message->name = "Andrey Lepeshkin";
		$message->bytes = "Some bytes";
		$message->write($writer);
		
		$reader = PhpBuf_IO_Reader::createFromWriter($writer);
		$message = new PhpBuf_Message_Example();
		$message->read($reader);
		
		$this->assertEquals(150, $message->id);
		$this->assertEquals(-12345, $message->balance);		
		$this->assertTrue($message->isAdmin);
		$this->assertEquals("deleted", $message->status);		
		$this->assertEquals("Andrey Lepeshkin", $message->name);		
		$this->assertEquals("Some bytes", $message->bytes);		
    }
    public function testMessageWriter_GoogleTest1() {
    	$message = new PhpBuf_Message_Example_Test1();
    	$message->a = 150;
    	$writer = new PhpBuf_IO_Writer();
    	$message->write($writer);
    	$this->assertEquals("08 96 01", $this->bytesToHexString($writer->getData()));
    }
    public function testMessageWriter_GoogleTest2() {
    	$message = new PhpBuf_Message_Example_Test2();
    	$message->b = "testing";
    	$writer = new PhpBuf_IO_Writer();
    	$message->write($writer);
    	$this->assertEquals("12 07 74 65 73 74 69 6e 67", $this->bytesToHexString($writer->getData()));
    }
    public function testMessageWriter_GoogleTest3() {
    	$messageTest1 = new PhpBuf_Message_Example_Test1();
    	$messageTest1->a = 150;
    	$message = new PhpBuf_Message_Example_Test3();
    	$message->c = $messageTest1;
    	$writer = new PhpBuf_IO_Writer();
    	$message->write($writer);
    	$this->assertEquals("1a 03 08 96 01", $this->bytesToHexString($writer->getData()));
    }
    public function testNestedMessages() {
    	$messageTest1 = new PhpBuf_Message_Example_Test1();
    	$messageTest1->a = 150;
    	$message = new PhpBuf_Message_Example_Test3();
    	$message->c = $messageTest1;
    	$writer = new PhpBuf_IO_Writer();
    	$message->write($writer);
    	
    	$reader = PhpBuf_IO_Reader::createFromWriter($writer);
		$message = new PhpBuf_Message_Example_Test3();
		$message->read($reader);
		
		$this->assertType("PhpBuf_Message_Example_Test1", $message->c);
		$this->assertEquals(150, $message->c->a);
		
		$message->c->a = 130;
		$writer = new PhpBuf_IO_Writer();
		$message->write($writer);
		$this->assertEquals("1a 03 08 82 01", $this->bytesToHexString($writer->getData()));
    }
	public function testSetWrongTypes() {
		$this->setExpectedException('PhpBuf_Field_Exception');
        $message = new PhpBuf_Message_Example();
		$message->id = "Some text";	
    }
	public function testSetWrongTypeForFieldInt() {
		$this->setExpectedException('PhpBuf_Field_Exception');
        $message = new PhpBuf_Message_Example();
		$message->id = "Some text";	
    }
	public function testSetWrongTypeForFieldSInt() {
		$this->setExpectedException('PhpBuf_Field_Exception');
        $message = new PhpBuf_Message_Example();
		$message->balance = array();	
    }
	public function testSetWrongTypeForFieldBool() {
		$this->setExpectedException('PhpBuf_Field_Exception');
        $message = new PhpBuf_Message_Example();
		$message->isAdmin = 45;	
    }
	public function testSetWrongTypeForFieldEnum_v1() {
		$this->setExpectedException('PhpBuf_Field_Exception');
        $message = new PhpBuf_Message_Example();
		$message->status = 1;	
    }
	public function testSetWrongTypeForFieldEnum_v2() {
		$this->setExpectedException('PhpBuf_Field_Exception');
        $message = new PhpBuf_Message_Example();
		$message->status = "banned";	
    }
	public function testSetWrongTypeForFieldString() {
		$this->setExpectedException('PhpBuf_Field_Exception');
        $message = new PhpBuf_Message_Example();
		$message->name = array();	
    }
	public function testSetWrongTypeForFieldBytes() {
		$this->setExpectedException('PhpBuf_Field_Exception');
        $message = new PhpBuf_Message_Example();
		$message->bytes = array();	
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
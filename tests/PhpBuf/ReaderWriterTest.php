<?php
class PhpBuf_ReaderWriterTest extends PHPUnit_Framework_TestCase {
	public function testWriteBytes() {
        $writer = new PhpBuf_IO_Writer();
        $writer->writeBytes("Test");
        $this->assertEquals(4, $writer->getLenght(), "Lenght failure");
        $this->assertEquals("Test", $writer->getData(), "Data failure");
        $writer->writeBytes(" Test");
        $this->assertEquals(9, $writer->getLenght(), "Lenght failure");
        $this->assertEquals("Test Test", $writer->getData(), "Data failure");
    }
	public function testWriteByteWithLenghtMoreThan1() {
		$this->setExpectedException('PhpBuf_IO_Exception');
		$writer = new PhpBuf_IO_Writer();
        $writer->writeByte("Test");

	}
	public function testWriteByte() {
		$writer = new PhpBuf_IO_Writer();
        $writer->writeByte("T");
        $this->assertEquals(1, $writer->getLenght(), "Lenght failure: " . $writer->getLenght() . ", " . $writer->getData());
        $this->assertEquals("T", $writer->getData(), "Data failure: " . $writer->getData());
        $writer->writeByte("e");
        $this->assertEquals(2, $writer->getLenght(), "Lenght failure: " . $writer->getLenght() . ", " . $writer->getData());
        $this->assertEquals("Te", $writer->getData(), "Data failure: " . $writer->getData());
	}
	public function testWriterRedo() {
		$writer = new PhpBuf_IO_Writer();
        $writer->writeBytes("One");
        $writer->writeBytes("Two");
        $writer->writeBytes("Three");
        $this->assertEquals(11, $writer->getLenght(), "Lenght failure: " . $writer->getLenght() . ", " . $writer->getData());
        $this->assertEquals("OneTwoThree", $writer->getData(), "Data failure: " . $writer->getData());
        $lastRecord = $writer->redo();
        $this->assertEquals(6, $writer->getLenght(), "Lenght failure: " . $writer->getLenght() . ", " . $writer->getData());
        $this->assertEquals("OneTwo", $writer->getData(), "Data failure: " . $writer->getData());
        $this->assertEquals("Three", $lastRecord, "Last record failure: " . $lastRecord);
	}
	
	public function testReaderGet() {
		$reader = new PhpBuf_IO_Reader("String for test");
		$this->assertEquals("S", $reader->getByte());
		$this->assertEquals(1, $reader->getPosition());
		$this->assertEquals("t", $reader->getByte());
		$this->assertEquals(2, $reader->getPosition());
		$this->assertEquals("ring", $reader->getBytes(4));
		$this->assertEquals(6, $reader->getPosition());
		$reader->setPosition(7);
		$this->assertEquals(7, $reader->getPosition());
		$this->assertEquals("for", $reader->getBytes(3));
		$this->assertEquals(10, $reader->getPosition());
		$reader->redo();
		$this->assertEquals(7, $reader->getPosition());
		$this->assertEquals("for", $reader->getBytes(3));
		$this->assertEquals(10, $reader->getPosition());
	}
}
?>
<?php
class PhpBuf_BackwardCompatibilityTest extends PHPUnit_Framework_TestCase {
    public function testReadMessageWithUnknownField(){
        $message = new PhpBuf_Message_Example_Compatible_NewAPI();
        $writer = new PhpBuf_IO_Writer();
        $message->a = 150;
        $message->b = "Old API should ignore this field value";
        $message->write($writer);

        $reader = PhpBuf_IO_Reader::createFromWriter($writer);
        $message = new PhpBuf_Message_Example_Compatible_OldAPI();
        $message->read($reader, false); // disable the strict reading mode
        $this->assertEquals($message->a, 150);
    }
}
?>

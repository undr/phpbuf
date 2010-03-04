<?php

abstract class PhpBuf_RPC_Socket_Service_Client {
    
    const TAG_SERVICE_NAME = 10;
    const TAG_METHOD_NAME = 18;
    const TAG_REQUEST = 26;
    
    protected $host;
    
    protected $port;
    
    public function __construct($host, $port){
        $this->host = $host;
        $this->port = $port;
    }
    
    protected abstract function getServiceFullQualifiedName();
    
    public function call($methodName, PhpBuf_Message_Abstract $request, $responderClassName){
        $tmpWriter = new PhpBuf_IO_Writer;
        $request->write($tmpWriter);
        
        $writer = new PhpBuf_IO_Writer;
        self::writeString($writer, self::TAG_SERVICE_NAME, $this->getServiceFullQualifiedName());
        self::writeString($writer, self::TAG_METHOD_NAME, $methodName);
        self::writeString($writer, self::TAG_REQUEST, $tmpWriter->getData());
        
        $socket = new PhpBuf_RPC_Socket($this->host, $this->port);
        $socket->write($writer->getData(), $writer->getLenght());
        $socket->shutdownWrite();
        
        $resonse = $socket->read(1024 * 1024);
        $socket->shutdownRead();
        
        $reader = new PhpBuf_IO_Reader($resonse);
        $instance = new $responderClassName;
        $instance->read($reader);
        return $instance;
    }
    
    protected static function writeString(PhpBuf_IO_Writer_Interface $writer, $fieldNumber, $value){
        PhpBuf_Base128::encodeToWriter($writer, $fieldNumber);
        PhpBuf_WireType_LenghtDelimited::write($writer, $value);
    }
    
}
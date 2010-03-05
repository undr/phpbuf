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
//        used by: http://code.google.com/p/protobuf-socket-rpc/
//
//        $tmpWriter = new PhpBuf_IO_Writer;
//        $request->write($tmpWriter);
//
//        $writer = new PhpBuf_IO_Writer;
//        self::writeString($writer, self::TAG_SERVICE_NAME, $this->getServiceFullQualifiedName());
//        self::writeString($writer, self::TAG_METHOD_NAME, $methodName);
//        self::writeString($writer, self::TAG_REQUEST, $tmpWriter->getData());
        
        $writer = new PhpBuf_IO_Writer;
        $request->write($writer);
        
        $socket = new PhpBuf_RPC_Socket($this->host, $this->port);
        $socket->write($writer->getData(), $writer->getLenght());
        $socket->shutdownWrite();
        
        $response = $socket->read(1024 * 1024);
        $socket->shutdownRead();
        $socket->close();
        
        //$responseWriter = new PhpBuf_IO_Writer();
        //$responseWriter->writeBytes($resonse);
        //PhpBuf_IO_Reader::createFromWriter($responseWriter);
        
        $instance = new $responderClassName;
        $instance->read(new PhpBuf_IO_Reader($response));
        return $instance;
    }
    
    protected static function writeString(PhpBuf_IO_Writer_Interface $writer, $fieldNumber, $value){
        PhpBuf_Base128::encodeToWriter($writer, $fieldNumber);
        PhpBuf_WireType_LenghtDelimited::write($writer, $value);
    }
    
}
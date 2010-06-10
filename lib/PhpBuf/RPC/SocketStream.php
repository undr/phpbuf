<?php

class PhpBuf_RPC_SocketStream implements PhpBuf_RPC_Socket_Interface {
    
    protected $socket;
    
    protected $closed = false;
    
    public function __construct($host, $port){
        // T.B.D
    }
    
    public function read($length){
        // T.B.D
    }
    
    public function write($data, $length = null){
        // T.B.D
    }
    
    public function shutdownRead(){
        stream_socket_shutdown($this->socket, STREAM_SHUT_RD);
    }
    
    public function shutdownWrite(){
        stream_socket_shutdown($this->socket, STREAM_SHUT_WR);
    }
    
    public function shutdown(){
        stream_socket_shutdown($this->socket, STREAM_SHUT_RDWR);
    }
    
    public function close(){
        @fclose($this->socket);
    }
}
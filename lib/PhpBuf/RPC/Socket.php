<?php

class PhpBuf_RPC_Socket {
    
    const DEFAULT_IPADDR = '127.0.0.1';
    
    const SOCKET_READ_END = 0;
    
    const SOCKET_WRITE_END = 1;
    
    const SOCKET_READ_WRITE_END = 2;
    
    protected $socket;
    
    protected $closed = false;
    
    public function __construct($host, $port){
        $ipAddr = self::DEFAULT_IPADDR;
        if(false === ip2long($host)){
            $ipAddr = gethostbyname($host);
        } else {
            $ipAddr = $host;
        }
        
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if(false === $socket){
            throw new PhpBuf_RPC_Socket_Exception('socket creation fail:' . socket_strerror(socket_last_error()));
        }
        
        $connected = socket_connect($socket, $ipAddr, $port);
        if(false === $connected){
            throw new PhpBuf_RPC_Socket_Exception('socket connection fail:' . socket_strerror(socket_last_error()));
        }
        
        socket_set_block($socket);
        // socket_set_timeout($socket, 5);
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 5, 'usec' => 0));
        socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_set_option($socket, SOL_SOCKET, SO_LINGER, array('l_onoff' => 1, 'l_linger' => 1));
        $this->socket = $socket;
    }
    public function __destruct(){
        if(!$this->closed){
            $this->close();
        }
    }
    
    public function read($length){
        $result = socket_read($this->socket, $length, PHP_BINARY_READ);
        if(false === $result){
            throw new PhpBuf_RPC_Socket_Exception('read error');
        }
        return $result;
    }
    
    public function write($data, $length = null){
        $result = @socket_write($this->socket, $data, $length);
        if(false === $result){
            throw new PhpBuf_RPC_Socket_Exception('write error');
        }
        return $result;
    }
    
    public function shutdownRead(){
        return @socket_shutdown($this->socket, self::SOCKET_READ_END);
    }
    
    public function shutdownWrite(){
        return @socket_shutdown($this->socket, self::SOCKET_WRITE_END);
    }
    
    public function shutdown(){
        return @socket_shutdown($this->socket, self::SOCKET_READ_WRITE_END);
    }
    
    public function close(){
        $this->closed = true;
        @socket_close($this->socket);
    }
}

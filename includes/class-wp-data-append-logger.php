<?php

class Logger {
    
    private $logFilePath;
    private $fileHandle;
    private $logPrefix;
    
    public function __construct($path, $fileExtension = '.txt') {
        try {
            $this->logFilePath = $path . 'DataAppend-' . date('Y-m-d') . $fileExtension;
            $this->fileHandle = fopen($this->logFilePath, 'a');
            $this->logPrefix = '<' . date('Y-m-d G:i:s') . '> ';   
        }
        catch (Exception $e) {
            
        }
    }
    
    public function __destruct() {
        if ($this->fileHandle) {
            fclose($this->fileHandle);
        }
    }
    
    public function info($message) {
        $this->write('[INFO] ' . $message);
    }
    
    public function error($message) {
        $this->write('[ERROR] ' . $message);
    }   
    
    public function warning($message) {
        $this->write('[WARNING] ' . $message);
    }
    
    private function write($message) {
        try {
            fwrite($this->fileHandle, "\n" . $this->logPrefix . $message);    
        }
        catch(Exception $e) {
            
        }
    }
}
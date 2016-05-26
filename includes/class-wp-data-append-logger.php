<?php

class Logger {
    private $logFilePath;
    private $fileHandle;
        
    public function __construct($path, $fileExtension = '.txt') {
        $this->logFilePath = $path . 'DataAppend-' . date('Y-m-d') . $fileExtension;
        $this->fileHandle = fopen($this->logFilePath, 'a');
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
        fwrite($this->fileHandle, "\n" . '<' . date('Y-m-d G:i:s') . '> ' . $message);    
    }
}
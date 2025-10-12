<?php

class Logger {
    private static $instance;
    private $logFile;
    private const LOG_PATH = __DIR__ . '/../logs';

    private function __construct() {
        // Create logs directory if it doesn't exist
        if (!file_exists(self::LOG_PATH)) {
            mkdir(self::LOG_PATH, 0777, true);
        }
        $this->logFile = self::LOG_PATH . '/api.log';
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    public function log($level, $message, $context = []) {
        // Format: [YYYY-MM-DD HH:MM:SS] [LEVEL] Message {context}
        $timestamp = date('Y-m-d H:i:s');
        $levelStr = strtoupper($level);
        $contextStr = !empty($context) ? json_encode($context, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : '';

        $logEntry = "[$timestamp] [$levelStr] $message $contextStr" . PHP_EOL;

        // Append to the log file with an exclusive lock
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }

    public function info($message, $context = []) {
        $this->log('info', $message, $context);
    }

    public function error($message, $context = []) {
        $this->log('error', $message, $context);
    }

    public function warning($message, $context = []) {
        $this->log('warning', $message, $context);
    }

    public function debug($message, $context = []) {
        $this->log('debug', $message, $context);
    }
}

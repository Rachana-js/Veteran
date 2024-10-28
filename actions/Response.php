<?php

class Response {

    private $message = array();

    public function __construct() {

    }

    public function addKeyValue($key, $value) {
        $this->message[$key] = $value;
    }

    public function success($value) {
        $this->addKeyValue('success', true);
        $this->addKeyValue('body', $value);
    }

    public function error($value) {
        $this->addKeyValue('success', false);
        $this->addKeyValue('error', $value);
    }

    public function writeResponse() {
        header('Content-Type: application/json');
        echo json_encode($this->message);
    }

}

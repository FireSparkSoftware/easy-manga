<?php

class Answer {

    public $responseCode = 200;

    public $success = true;

    public $message = "";

    public function json() {

        return json_encode( $this );

    }

    public function setResponseCode() {

        http_response_code( $this->responseCode );

    }

    public function __construct( $success = true, $message = "" ) {

        $this->success = $success; $this->message = $message;

    }

}
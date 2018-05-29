<?php
include_once "class-answer.php";

class PageManager {

    private $answer;

    public function setAnswer( $message = "", $success = true, $responseCode = null ) {

        $this->answer->success = $success; $this->answer->message = $message;
        
        if ( $responseCode )
            $this->answer->responseCode = $responseCode;

    }

    public function __construct() {

        $this->answer = new Answer();

        if ( !$this->contentCheck() ) {

            $this->setAnswer( CONTENT_DIR . " directory not found", false, 500 );
            exit;

        }

    }

    public function getAnswer() {

        $this->answer->setResponseCode();

        return $this->answer->json();

    }

    public function contentCheck() {

        return is_dir( CONTENT_DIR );

    }

}
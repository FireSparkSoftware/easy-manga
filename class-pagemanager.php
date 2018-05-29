<?php
include_once "class-answer.php";

class PageManager {

    private $manga = null, $episode = null, $page = null, $answer;

    public function set( $message = "", $success = true, $responseCode = null ) {

        $this->answer->success = $success; $this->answer->message = $message;
        
        if ( $responseCode != null )
            $this->answer->responseCode = $responseCode;

    }

    public function __construct( $manga = null, $episode = null, $page = null ) {

        $this->manga = $manga; $this->episode = $episode; $this->page = $page;
        $this->answer = new Answer();

        if ( !$this->contentCheck() ) {

            $this->set( CONTENT_DIR . " directory not found", false, 500 );
            exit;

        }

        $this->set( var_export( array( $manga, $episode, $page ), true ), false, 404 );

    }

    public function getAnswer() {

        $this->answer->setResponseCode();

        return $this->answer->json();

    }

    public function contentCheck() {

        return is_dir( CONTENT_DIR );

    }

}
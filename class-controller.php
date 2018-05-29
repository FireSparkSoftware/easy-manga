<?php
include "class-pagemanager.php";
include "class-mangalister.php";

class Controller extends PageManager {

    private $manga = null, $episode = null, $page = null;

    public function selam(){

        $this->setAnswer("selam", true, 201);

    }

    public function __construct( $manga = null, $episode = null, $page = null ) {
        parent::__construct();

        $this->manga = trim( $manga ); $this->episode = trim( $episode ); $this->page = trim( $page );

        if ( $this->page && $this->episode && $this->manga ) {

            

        } elseif ( $this->episode && $this->manga ) {
    
            $this->sendList( MangaLister::listPages( $this->manga, $this->episode ) );

        } elseif ( $this->manga ) {

            $this->sendList( MangaLister::listEpisodes( $this->manga ) );

        } else {

            $this->setAnswer( MangaLister::listMangas() );

        }

    }

    public function sendList( $list = null ){

        if ( $list )
            $this->setAnswer( $list );
        
        else
            $this->setAnswer( "Not found.", false, 404 );

    }

}
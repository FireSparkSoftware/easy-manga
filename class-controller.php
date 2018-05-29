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

        if ( $this->episode && $this->manga ) {
    
            $this->sendList( MangaLister::listPages( $this->manga, $this->episode ) );

        } elseif ( $this->manga ) {

            $details = MangaLister::getMangaDetails( $this->manga );

            $list = MangaLister::listEpisodes( $this->manga );

            if ( $details == null && $list == null ) 

                $this->setAnswer( "Not found.", false, 404 );

            else

                $this->setAnswer( array( "details" => $details, "episodes" => $list ) );

        } else {

            $this->sendList( MangaLister::listMangas() );

        }

    }

    public function sendList( $list = null ){

        if ( $list )
            $this->setAnswer( $list );
        
        else
            $this->setAnswer( "Not found.", false, 404 );

    }

}
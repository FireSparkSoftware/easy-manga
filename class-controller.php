<?php
include "class-pagemanager.php";
include "class-mangalister.php";

class Controller extends PageManager {

    const notFoundMsg = "Not found.";

    private $manga = null, $episode = null, $page = null;

    public function __construct( $manga = null, $episode = null, $page = null ) {
        parent::__construct();

        if ( $this->answer->success ) {

            $this->manga = trim( $manga ); $this->episode = trim( $episode ); $this->page = trim( $page );

            $this->prepareAnswer();            
            
        }
        
    }
    
    public function prepareAnswer() {
        
        if ( $this->episode && $this->manga ) {
    
            $list = MangaLister::listPages( $this->manga, $this->episode );
    
            if ( $list )
                $this->setAnswer( $list );
            
            else
                $this->setAnswer( self::notFoundMsg, false, 404 );
    
        } elseif ( $this->manga ) {
    
            $details = MangaLister::getMangaDetails( $this->manga );
    
            $list = MangaLister::listEpisodes( $this->manga );
    
            if ( $details == null && $list == null ) 
    
                $this->setAnswer( self::notFoundMsg, false, 404 );
    
            else
    
                $this->setAnswer( array( "details" => $details, "episodes" => $list ) );
    
        } else {
    
            $mangaList = MangaLister::listMangas();
    
            if ( $mangaList == null ) {
    
                $this->setAnswer( self::notFoundMsg, false, 404 );
    
            } else {
    
                $list = array();
    
                foreach ( $mangaList as $manga ) {
    
                    $detail = MangaLister::getMangaDetails( $manga );
                    $list[ $manga ] = ($detail) ? $detail : "No detail." ;
    
                }
    
                $this->setAnswer( $list );
                
            }
    
        }
        
    }
    
}
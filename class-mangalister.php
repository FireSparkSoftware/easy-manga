<?php

class MangaLister {

    const CONTENT_DIR = "content/";

    public static function listMangas() {

        return self::deleteDots( scandir( self::CONTENT_DIR ) );

    }

    public static function listEpisodes( $mangaName ) {

        if ( $mangaName ) {
        
            return self::deleteDots( scandir( self::CONTENT_DIR . $mangaName ) );
        
        } else {

            return null;

        }

    }

    private static function deleteDots( $dirList = array() ) {

        return array_diff( $dirList, array( ".", ".." ) );

    }

}
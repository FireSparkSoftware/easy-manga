<?php

class MangaLister {

    const CONTENT_DIR = "content/";

    public static function listMangas() {

        return self::deleteDots( scandir( self::CONTENT_DIR ) );

    }

    public static function listEpisodes( $mangaName ) {

        $validPath = self::validPath( self::CONTENT_DIR . $mangaName );

        if ( $mangaName && $validPath ) {
        
            return self::deleteDots( scandir( $validPath ) );
        
        } else {

            return null;

        }

    }

    private static function deleteDots( $dirList = array() ) {

        return array_diff( $dirList, array( ".", ".." ) );

    }

    private static function validPath( $path ) {

        $realPath = realpath ( $path );
        $realContentPath = realpath( self::CONTENT_DIR );

        if ( substr( $realPath, 0, strlen( $realContentPath ) ) == $realContentPath ) {

            return $realPath;

        } else {

            return false;
        
        }

    }

}
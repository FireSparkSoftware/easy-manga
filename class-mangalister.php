<?php

class MangaLister {

    public static function listMangas() {

        return self::deleteDots( scandir( CONTENT_DIR ) );

    }

    public static function listEpisodes( $manga ) {

        $validPath = self::validPath( CONTENT_DIR . $manga );

        if ( $manga && $validPath ) {
        
            return self::deleteDots( scandir( $validPath ) );
        
        } else {

            return null;

        }

    }

    public static function listPages( $manga, $episode ) {

        $validPath = self::validPath( CONTENT_DIR . $manga . DIRECTORY_SEPARATOR . $episode );

        if ( $manga && $episode && $validPath ) {

            return self::deleteDots( scandir( $validPath ) );

        } else {

            return null;

        }

    }

    private static function deleteDots( $dirList = array() ) {

        return array_values( array_diff( $dirList, array( ".", ".." ) ) );

    }

    private static function validPath( $path ) {

        $realPath = realpath ( $path );
        $realContentPath = realpath( CONTENT_DIR );

        if ( substr( $realPath, 0, strlen( $realContentPath ) ) == $realContentPath ) {

            return $realPath;

        } else {

            return false;
        
        }

    }

}
<?php

class MangaLister {

    public static function listMangas() {

        return self::deleteDots( scandir( CONTENT_DIR ) );

    }

    public static function listEpisodes( $manga ) {

        return self::listDirectory( $manga );

    }

    public static function listPages( $manga, $episode ) {

        return self::listDirectory( $manga . DIRECTORY_SEPARATOR . $episode );

    }

    private static function listDirectory( $directory ) {

        $validPath = self::validPath( CONTENT_DIR . $directory );

        if ( $validPath ) {

            return self::deleteDots( scandir( $validPath ) );

        } else {

            return null;

        }

    }

    private static function deleteDots( $dirList = array() ) {

        return array_values( array_diff( $dirList, array( ".", "..", DETAILS_JSON_FILE ) ) );

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

    public static function getMangaDetails( $manga ) {

        $validPath = self::validPath( CONTENT_DIR . $manga );

        $file = $validPath . DIRECTORY_SEPARATOR . DETAILS_JSON_FILE;

        if ( $manga && $validPath && is_file( $file ) ) {
        
            return json_decode( file_get_contents( $file ) );
        
        } else {

            return null;

        }

    }

}
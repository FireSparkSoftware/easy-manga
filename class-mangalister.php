<?php

class MangaLister {

    public static function listMangas() {

        return self::listDirectory();

    }

    public static function listEpisodes( $manga ) {

        return self::listDirectory( $manga );

    }

    public static function listPages( $manga, $episode ) {

        return self::listDirectory( $manga . DIRECTORY_SEPARATOR . $episode, false );

    }

    private static function listDirectory( $directory = "", $onlyDir = true ) {

        $validPath = self::validPath( CONTENT_DIR . DIRECTORY_SEPARATOR . $directory );

        if ( $validPath ) {

            $inside = self::deleteDots( scandir( $validPath ) );

            if ( $onlyDir ) {

                $list = array();
                foreach ($inside as $element) {

                    if ( is_dir($validPath . DIRECTORY_SEPARATOR . $element) )

                        $list[] = $element;

                }

                return $list;

            }
            
            return $inside;

        } else

            return null;

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

        $validPath = self::validPath( CONTENT_DIR . DIRECTORY_SEPARATOR . $manga );

        $file = $validPath . DIRECTORY_SEPARATOR . DETAILS_JSON_FILE;

        if ( $manga && $validPath && is_file( $file ) ) {
        
            return json_decode( file_get_contents( $file ) );
        
        } else {

            return null;

        }

    }

}
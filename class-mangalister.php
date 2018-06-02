<?php

class MangaLister {

    public static function listMangas() {

        return self::listDirectory();

    }

    public static function listEpisodes( $manga ) {

        return self::listDirectory( $manga );

    }

    public static function listPages( $manga, $episode ) {

        $list = self::listDirectory( $manga . DIRECTORY_SEPARATOR . $episode, false );

        for ( $i=0; $i < count($list); $i++ )

            $list[$i] = self::getFileURL( $manga . "/" . $episode . "/" . $list[$i] );

        return $list;

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
        
        if ( $validPath ) {

            $coverURL = self::getCoverURL( $manga );

            if ( is_file( $file ) ){

                $details = json_decode( file_get_contents( $file ) );

                if ( $coverURL )

                    $details->cover = $coverURL;
                    
                return $details;

            } elseif ( $coverURL ){

                return array( "cover" => $coverURL );

            }
        
            return null;
        
        }

        return null;

    }

    public static function getFileURL( $file ) {

        return APP_REMOTE_DIR . CONTENT_DIR . "/" . $file;

    }

    public static function getCoverURL( $manga ) {

        $list = self::listDirectory( $manga, false );

        foreach ( $list as $element ) {
            
            $ext = explode( ".", $element );

            if ( end($ext) == "png" || end($ext) == "jpg" ) {

                return self::getFileURL( $manga . "/" . $element );

            }

        }

        return false;

    }

}
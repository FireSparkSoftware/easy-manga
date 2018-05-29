<?php

define( "CONTENT_DIR", "content" . DIRECTORY_SEPARATOR );
define( "DETAILS_JSON_FILE", "details.json" );

include_once "class-controller.php";

$pages = new Controller( @$_GET["manga"], @$_GET["episode"], @$_GET["page"] );

header("Content-Type: application/json; charset=UTF-8");

echo $pages->getAnswer();
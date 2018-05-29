<?php

define( "CONTENT_DIR", "content" . DIRECTORY_SEPARATOR );

include_once "class-pagemanager.php";

$pages = new PageManager( @$_GET["manga"], @$_GET["episode"], @$_GET["page"] );

header("Content-Type: application/json; charset=UTF-8");

echo $pages->getAnswer();
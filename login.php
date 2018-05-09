<?php

// This page is used to login to the forum

require_once "common.php";

$meta = array(
              "description" => "Login to the forum",
              "author"      => "John"
            );

$title = isset( $_GET[ "title" ] ) ? $_GET[ "title" ] : "Login";

displayHeader( $meta, $title );

displayFooter();

?>
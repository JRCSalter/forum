<?php

session_start();

require_once "common.php";
require_once "DataObject.php";
Require_once "Users.class.php";

$meta = array(
              "description" => "Logout from the forum",
              "author"      => "John"
            );

$title = isset( $_GET[ "title" ] ) ? $_GET[ "title" ] : "Logout";

displayHeader( $meta, $title );

session_unset();
session_destroy();

if ( !isset( $_SESSION[ "name" ] ) )
{
  echo "You have been logged out.<br>";
  echo "Please come back soon.";
}

?>

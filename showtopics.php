<?php

// Displays all topics, and links to their comments

session_start();

require_once "DataObject.php";
require_once "Users.class.php";
require_once "Topics.class.php";
require_once "Posts.class.php";
require_once "common.php";

$meta = array(
               "description" => "A Forum",
               "author"      => "John"
             );

$title = isset( $_GET[ "title" ] ) ? $_GET[ "title" ] : "Topics";
$id    = isset( $_GET[ "id"    ] ) ? $_GET[ "id"    ] : "";

displayHeader( $meta, $title );

if ( !isset( $_SESSION[ "name" ] ) )
{
  ?>

  <a href='signup.php'><button>Sign Up</button></a>
  <a href='login.php'><button>Login</button></a>

  <?php
}
else
{
  echo "<br>Logged in as: " . $_SESSION[ "name" ] . "<br>";

  ?>

  <a href="logout.php"><button>Logout</button></a>

  <?php
}

if ( $title == "Topics" )
{
  $topics = Topic::getTopics();

  $topicRows = array();

  foreach ( $topics as $topic )
  {
    $author = User::getUser( $topic->getValue( "author" ) );
    $id     = $topic->getValue( "id" );
    $title  = $topic->getValueEncoded( "title" );

    $topicTitle  = "<a href=\"showtopics.php?title=" .
                   $title                            .
                   "&id="                            .
                   $id                               .
                   "\">"                             .
                   $title                            .
                   "</a>";

    // Set and associative array for the row
    $topicRow[ "title"    ] = $topicTitle;
    $topicRow[ "author"   ] = $author[ "name" ];
    $topicRow[ "postTime" ] = $topic->getValue( "postTime" );

    $topicRows[] = $topicRow;
  }

  $topicHeaders = array( "Title", "Author", "Posted" );

  makeTable( $topicHeaders, $topicRows );
}
else
{
  $posts = Post::getThread( $id );
  $postRows = array();

  foreach ( $posts as $post )
  {
    $author = User::getUser( $post->getValue( "author" ) );

    $postRow[ "content"  ] = $post->getValue( "content"  );
    $postRow[ "author"   ] = $author[ "name"             ];
    $postRow[ "postTime" ] = $post->getValue( "postTime" );

    $postRows[] = $postRow;
  }

  $postHeaders = array( "Content", "Author", "Posted" );

  makeTable( $postHeaders, $postRows );
}

displayFooter();
?>

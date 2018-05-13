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

if( !$_SESSION )
{
  echo "You need to be logged in to post topics<br>";
  echo "<a href='index.php'><button>Home</button></a>";
}
else if( !$_POST )
{
  ?>

  <form action='addtopic.php' method='post'>
    <label for='title'>Title</label>
    <input type='text' name='title' value="">

    <textarea name='content' rows="8" cols="80"></textarea>

    <button type='submit' name='submit'>Submit</button>
  </form>

  <?php
}
else
{
  $title   = $_POST[ "title"   ];
  $content = $_POST[ "content" ];
  $author  = $_SESSION[ "id" ];

  $topicData = array(
                      "title"  => $title,
                      "author" => $author
                    );

  $topic = new Topic( $topicData );

  $topic->insertTopic();

  $newTopic = Topic::getTopicByTitle( $title );
  $topicId  = $newTopic[ "id" ];

  $postData = array (
                      "content" => $content,
                      "author"  => $author,
                      "topic"   => $topicId
                    );

  $post = new Post( $postData );

  $post->insertPost();
}

?>

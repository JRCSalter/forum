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
  echo "You need to be logged in to post<br>";
  echo "<a href='index.php'><button>Home</button></a>";
}
else if( !$_POST )
{
  echo "<h1>Post Comment</h1>";

  ?>

  <form action='addpost.php?id=<?php echo $id ?>' method='post'>

    <textarea name="content" rows="8" cols="80"></textarea>
    <input type="submit" name="submit" value="Submit">

  </form>

  <?php
}
else
{
  $user  = User::getUserByName( $_SESSION[ "name" ] );
  $topic = Topic::getTopic( $id );
  // print_r($user);
  // echo "<br>";
  // print_r($topic);

  $content = $_POST[ "content" ];

  $data = array(
                 "content" => $content,
                 "author"  => $user[  "id" ],
                 "topic"   => $topic[ "id" ]
               );
print_r($data);
  $post = new Post( $data );

  $post->insertPost();

  print_r($post);
  echo "Comment submitted";
}

?>

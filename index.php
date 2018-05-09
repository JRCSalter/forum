<?php

require_once "DataObject.php";
require_once "Users.class.php";
require_once "Topics.class.php";
require_once "Posts.class.php";
require_once "common.php";

$meta = array(
          "description" => "A Forum",
          "author"      => "John"
        );

$title = "Forum";

$users = User::getUsers();

// This is a big idea that I want to implement
// So big I need another freakin' branch!!!

$userRows = array();
foreach ( $users as $user )
{
  $userRow[ "id"        ] = $user->getValue( "id"       );
  $userRow[ "name"      ] = $user->getValue( "name"     );
  $userRow[ "name"      ] = $user->getValue( "name"     );
  $userRow[ "age"       ] = $user->getValue( "age"      );
  $userRow[ "dob"       ] = $user->getValue( "dob"      );
  $userRow[ "password"  ] = $user->getValue( "password" );
  $userRow[ "joined"    ] = $user->getValue( "joined"   );
  $userRows[] = $userRow;
}

displayHeader( $meta, $title );

$headers = array("ID", "Name", "Age", "Date of Birth", "Password", "Joined" );

makeTable( $headers, $userRows );

$topics = Topic::getTopics();

$topicRows = array();

foreach ( $topics as $topic )
{
  $topicRow[ "id"       ] = $topic->getValue( "id"       );
  $topicRow[ "title"    ] = $topic->getValue( "title"    );
  $topicRow[ "author"   ] = $topic->getValue( "author"   );
  $topicRow[ "postTime" ] = $topic->getValue( "postTime" );
  $topicRows[] = $topicRow;
}

$topicHeaders = array("ID", "Title", "Author", "Posted");

makeTable( $topicHeaders, $topicRows );


$posts = Post::getPosts();

$postRows = array();

foreach ( $posts as $post )
{
  $author = User::getUser( $post->getValue( "author" ) );
  $topic  = Topic::getTopic( $post->getValue( "topic" ) );
  $postRow[ "id"       ] = $post->getValue( "id"       );
  $postRow[ "content"       ] = $post->getValue( "content"       );
  $postRow[ "author"       ] = $author[ "name" ];
  $postRow[ "topic"       ] = $topic[ "title" ];
  $postRow[ "postTime"       ] = $post->getValue( "postTime"       );
  $postRows[] = $postRow;
}

$postHeaders = array("ID", "Content", "Author", "Topic", "Posted");

makeTable( $postHeaders, $postRows );

$userInfo = User::getUser(1);

print_r($userInfo);

?>
<p>end</p>
<?php

displayFooter();
?>
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

$title = isset( $_GET[ "title" ] ) ? $_GET[ "title" ] : "Topics";
$id    = isset( $_GET[ "id"    ] ) ? $_GET[ "id"    ] : "";

displayHeader( $meta, $title );

?>

<a href='signup.php?displayForm=1'><button>Sign Up</button></a>

<?php

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

  echo "<p>start</p>";
  $posts = Post::getThread( $id );
  $postRows = array();
  
  foreach ( $posts as $post )
  {
    $author = User::getUser( $post[ "author" ] );

    $postRow[ "content"  ] = $post[ "content"  ];
    $postRow[ "author"   ] = $author[ "name"   ];
    $postRow[ "postTime" ] = $post[ "postTime" ];
    $postRows[] = $postRow;
  }
  
  $postHeaders = array( "Content", "Author", "Posted" );
  
  makeTable( $postHeaders, $postRows );
}

?>
<p>end</p>
<?php

displayFooter();
?>
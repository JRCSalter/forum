<?php

// Landing page

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

$title = "Forum";

displayHeader( $meta, $title );

echo "<h1>";

if ( isset( $_SESSION[ "name" ] ) )
{
  echo "Welcome back, " . $_SESSION[ "name" ] . "</h1>";
  echo "<a href='logout.php'><button>Logout</button></a><br>";
}
else
{
  echo "Welcome</h1>";
  echo "<a href='login.php'><button>Login</button></a><br>";
  echo "<a href='signup.php'><button>Signup</button></a><br>";
}

echo  "<a href='showtopics.php'><button>Show Topics</button></a><br>";

////////////////////////////////////////////////////////////////////////////////
// Uncomment for list of all users /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
// $users = User::getUsers();
//
// $userRows = array();
// foreach ( $users as $user )
// {
//   $userRow[ "id"        ] = $user->getValue( "id"       );
//   $userRow[ "name"      ] = $user->getValue( "name"     );
//   $userRow[ "name"      ] = $user->getValue( "name"     );
//   $userRow[ "age"       ] = $user->getValue( "age"      );
//   $userRow[ "dob"       ] = $user->getValue( "dob"      );
//   $userRow[ "password"  ] = $user->getValue( "password" );
//   $userRow[ "joined"    ] = $user->getValue( "joined"   );
//
//   $userRows[] = $userRow;
// }
//
// $headers = array("ID", "Name", "Age", "Date of Birth", "Password", "Joined" );
//
// makeTable( $headers, $userRows );
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
// Uncomment for list of all topics ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
// $topics = Topic::getTopics();
//
// $topicRows = array();
//
// foreach ( $topics as $topic )
// {
//   $topicRow[ "id"       ] = $topic->getValue( "id"       );
//   $topicRow[ "title"    ] = $topic->getValue( "title"    );
//   $topicRow[ "author"   ] = $topic->getValue( "author"   );
//   $topicRow[ "postTime" ] = $topic->getValue( "postTime" );
//
//   $topicRows[] = $topicRow;
// }
//
// $topicHeaders = array( "ID", "Title", "Author", "Posted" );
//
// makeTable( $topicHeaders, $topicRows );
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
// Uncomment for list of all posts /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
// $posts = Post::getPosts();
//
// $postRows = array();
//
// foreach ( $posts as $post )
// {
//   $author = User::getUser( $post->getValue( "author"  ) );
//   $topic  = Topic::getTopic( $post->getValue( "topic" ) );
//
//   $postRow[ "id"       ] = $post->getValue( "id"       );
//   $postRow[ "content"  ] = $post->getValue( "content"  );
//   $postRow[ "author"   ] = $author[ "name"             ];
//   $postRow[ "topic"    ] = $topic[ "title"             ];
//   $postRow[ "postTime" ] = $post->getValue( "postTime" );
//
//   $postRows[] = $postRow;
// }
//
// $postHeaders = array( "ID", "Content", "Author", "Topic", "Posted" );
//
// makeTable( $postHeaders, $postRows );
////////////////////////////////////////////////////////////////////////////////

?>
<!----------------------------------------------------------------------------->
<!-- Uncomment to show end of page -------------------------------------------->
<!-- <p>end</p> -->
<!----------------------------------------------------------------------------->
<?php

displayFooter();

?>

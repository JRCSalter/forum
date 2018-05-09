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

$title = isset( $_GET[ "title" ] ) ? $_GET[ "title" ] : "Sign Up";

displayHeader( $meta, $title );

$displayForm = $_GET[ "displayForm" ] ? TRUE : FALSE;

if ( $displayForm )
{
  displayInsert();
}
else
{
  $requiredFields = array( "name", "age", "dob", "password1", "password2" );
  $warnings       = array();

  foreach ( $_POST as $key => $value )
  {
    if ( in_array( $key, $requiredFields ) && ( $value == "" ) )
    {
      
      array_push( $warnings, $key );
    }
  }

  $name     = $_POST[ "name" ] ? preg_replace( "/[^a-zA-Z]/", " ", $_POST[ "name" ] ) : NULL;
  $age      = $_POST[ "age"  ] ? preg_replace( "/[^0-9]/",    " ", $_POST[ "age"  ] ) : NULL;
  $dob      = $_POST[ "dob"  ] ? preg_replace( "/[^0-9-]/",   " ", $_POST[ "dob"  ] ) : NULL;
  
  $password = ( $_POST[ "password1" ] == $_POST[ "password2" ] ) ? preg_replace( "/[^A-Za-z0-9-]/",   " ", $_POST[ "password1"  ] ) : NULL;

  $password = password_hash( $_POST[ "password1" ], PASSWORD_DEFAULT );

  if ( !empty( $warnings ) )
  {
    echo "<p class='warningText'>Some fields require your attention</p>";
    displayInsert( $warnings );
    die();
  }
  else
  {
  
    $data = array(
                   "name"     => $name,
                   "age"      => $age,
                   "dob"      => $dob,
                   "password" => $password
                 );
    
    $user = new User( $data );
  
    $user->insertUser();
  }
}

?>

<p>end</p>
<?php

displayFooter();
?>
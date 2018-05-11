<?php

// This page is used to login to the forum

session_start();

require_once "common.php";
require_once "DataObject.php";
Require_once "Users.class.php";

$meta = array(
              "description" => "Login to the forum",
              "author"      => "John"
            );

$title = isset( $_GET[ "title" ] ) ? $_GET[ "title" ] : "Login";

displayHeader( $meta, $title );

// Uncomment the following lines to reset the session for debugging
// session_unset();
// session_destroy();

if( $_POST[ "name" ] )
{
  if ( User::isVerified( $_POST[ "name" ], $_POST[ "password" ] ) )
  {
    $user = User::getUserByName( $_POST[ "name" ] );

    $_SESSION[ "id"      ] = $user[ "id"      ];
    $_SESSION[ "name"    ] = $user[ "name"    ];
    $_SESSION[ "age"     ] = $user[ "age"     ];
    $_SESSION[ "dob"     ] = $user[ "dob"     ];
    $_SESSION[ "joined"  ] = $user[ "joined"  ];

    echo "You have been logged in.<br>";
    echo "Welcome back, " . $_SESSION[ "name" ] . "<br>";

    ?>

    <a href="showtopics.php"><button>Home</button></a>

    <?php
  }
  else
  {
    echo "Incorrect username or password";
  }

}
else if( !$_SESSION[ "name" ] )
{
  ?>

  <form action='login.php' method ='post' id='loginForm'>
  	<table>
  		<tr>
  			<td>
  				<label for='name'>Username:</label>
  			</td>
        <td>
          <input type='text' name='name'>
        </td>
  		</tr>
      <tr>
        <td>
          <label for='password'>Password: </label>
        </td>
        <td>
          <input type='password' name='password'>
        </td>
      </tr>
      <tr>
        <td>
          <input type='submit' name='submit'>
        </td>
      </tr>
  	</table>
  </form>

  <?php
}
else
{
  echo "You are already logged in " . $_SESSION[ "name" ];
}

displayFooter();

?>

<?php

// This page is used to login to the forum

require_once "common.php";

$meta = array(
              "description" => "Login to the forum",
              "author"      => "John"
            );

$title = isset( $_GET[ "title" ] ) ? $_GET[ "title" ] : "Login";

displayHeader( $meta, $title );

?>

<form action='post' method ='login.php' id='loginForm'>
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

displayFooter();

?>
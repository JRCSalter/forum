<?php

function makeTable( $headers, $data )
// Creates a HTML table
// $headers is an array of titles that will be at the head of each column
// $data is a 2D array containing a list of rows
{
  ?>

  <table>

    <tr>
      <?php
      foreach ( $headers as $key => $value )
      {
        echo "<th>" . $value . "</th>
        ";
      }
      ?>
    </tr>

    <?php
    foreach ( $data as $key1 => $value1 )
    // Create a row and populate it with <td>
    {
      echo "<tr>
      ";

      foreach ( $value1 as $key2 => $value2 )
      {
        echo "<td>" . $value2 . "</td>
        ";
      }

      echo "</tr>
      ";
    }
    ?>

  </table>

  <?php
} // end makeTable()

function displayHeader( $meta, $title )
// Displays the Head of an HTML file along with the mata tags
// $meta is a 2D associative array
{

  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title><?php echo $title ?></title>

    <?php
    foreach ( $meta as $key => $value )
    // Populate the <meta> tags
    {
      echo "<meta name='" . $key   . "'";
      echo " content='"   . $value . "'";
      echo ">
      ";
    }
    ?>

  </head>
  <body>
  <?php
} // end displayHeader()

function displayFooter()
// Displays the closing tags for the <html>
{
  ?>
  </body>
  </html>
  <?php
} // end displayFooter()

function validateFields( $fieldName, $missingFields )
// Ensures required fields contain data in a form and assigns .error class
// $fieldName contains the name of the field to check
// $missingFields is an array of field names that require attention
{
  if ( in_array( $fieldName, $missingFields ) )
  {
    echo ' class="error"';
  }
} // end validateFields()

function displayInsert( $warnings )
// Displays the form to insert data into the Users table
// $warnings is an array containing the fields with incorrect data
{
  if ( $_POST )
  {
    // If the form has been submitted, filter the data
    // All values to be kept except for password

    $nameValue = preg_replace( "/[^a-zA-Z]/", " ", $_POST[ "name" ] );
    $ageValue  = preg_replace( "/[^0-9]/",    " ", $_POST[ "age"  ] );
    $dobValue  = preg_replace( "/[^0-9-]/",   " ", $_POST[ "dob"  ] );
  }

  if ( count( $warnings ) > 0 )
  {
    // Assign an empty string to fields if they are in the missing fields array

    $nameValue = in_array( $nameValue, $warnings ) ? "" : $nameValue;
    $ageValue  = in_array( $ageValue , $warnings ) ? "" : $ageValue ;
    $dobValue  = in_array( $dobValue , $warnings ) ? "" : $dobValue ;
  }

  ?>
  <form method='post' action='signup.php'>
    <table>

      <tr>

        <td>
          <label for='name'>Name: </label>
        </td>
        <td>
          <input type='text'
                 name='name'
                 id='insertName'
                 <?php
                 validateFields( "name", $warnings );
                 echo " value='" . $nameValue . "'";
          ?>>
        </td>

      </tr>

      <tr>

        <td>
          <label for='age'>Age: </label>
        </td>
        <td>
          <input type='number'
                 name='age'
                 id='insertAge'
                 <?php
                 validateFields( "age", $warnings );
                 echo " value='" . $ageValue . "'";
          ?>>
        </td>
      </tr>

      <tr>
        <td>
          <label for='dob'>Date of Birth: </label>
        </td>
        <td>
          <input type='date'
                 name='dob'
                 id='insertDob'
                 <?php
                 validateFields( "dob", $warnings );
                 echo " value='" . $dobValue . "'";
          ?>>
        </td>
      </tr>

      <tr>
        <td>
          <label for='password1'>Password: </label>
        </td>
        <td>
          <input type='password'
                 name='password1'
                 id='insertPassword1'
                 <?php
                 validateFields( "password1", $warnings );
          ?>>
        </td>
      </tr>

      <tr>
        <td>
          <label for='password2'>Re-enter Password: </label>
        </td>
        <td>
          <input type='password'
                 name='password2'
                 id='insertPassword2'
                 <?php
                 validateFields( "password2", $warnings );
          ?>>
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
} // end displayInsert()

?>

<?php

include "config.php";
// echo "stuff" . " More Stuff"
abstract class DataObject
{
  protected $data = array();


  // Take an array of data as argument and assign it to the $data array
  public function __construct ( $data )
  {
    foreach ( $data as $key => $value )
    {
      if ( array_key_exists( $key, $this->data ) )
      {
        $this->data[ $key ] = $value;
      }
    }
  } // end __construct()


  // Get a particular value from the $data array
  public function getValue( $field )
  {
    if ( array_key_exists( $field, $this->data ) )
    {
      return $this->data[ $field ];
    }
    else
    {
      die( "Field not found" );
    }
  } // end getValue()


  // Get a particular value and encode it for HTML
  public function getValueEncoded( $field )
  {
    return htmlspecialchars( $this->getValue( $field ) );
  } // end getValueEncoded()


  // Connect to a database
  protected function connect()
  {
    try
    {
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $conn->setAttribute( PDO::ATTR_PERSISTENT, true                   );
      $conn->setAttribute( PDO::ATTR_ERRMODE,    PDO::ERRMODE_EXCEPTION );
    }
    catch ( PDOException $e )
    {
      die( "Connection failed: " . $e->getMessage() );
    }

    return $conn;
  } // end connect()


  // Disconnect from a database
  protected function disconnect( $conn )
  {
    $conn = "";
  } // end disconnect()
} // end DataObject

?>

<?php

include "config.php";

abstract class DataObject
// Defines the common features for all database based classes
{
  protected $data = array();

  public function __construct ( $data )
  // Take an array of data as argument and assign it to the $data array
  {
    foreach ( $data as $key => $value )
    {
      if ( array_key_exists( $key, $this->data ) )
      {
        $this->data[ $key ] = $value;
      }
    }
  } // end __construct()

  public function getValue( $field )
  // Get a particular value from the $data array
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

  public function getValueEncoded( $field )
  // Get a particular value and encode it for HTML
  {
    return htmlspecialchars( $this->getValue( $field ) );
  } // end getValueEncoded()

  protected function connect()
  // Connect to a database
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

  protected function disconnect( $conn )
  // Disconnect from a database
  {
    $conn = "";
  } // end disconnect()
} // end DataObject

?>

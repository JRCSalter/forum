<?php

class Topic extends DataObject
{
  protected $data = array(
                           "id"       => "",
                           "title"    => "",
                           "author"   => "",
                           "postTime" => ""
                         );


  public function getTopics()
  {
    // Retrieve an array of all topics and the associated data

    $conn = parent::connect();

    $sql  = "SELECT
             *
             FROM
             topics
             ORDER BY
             postTime DESC";

    try
    {
      $st = $conn->query( $sql );

      foreach ($st->fetchAll() as $row)
      {
        $topics[] = new Topic( $row );
      }

      parent::disconnect();

      return $topics;
    }
    catch( PDOException $e )
    {
      parent::disconnect();
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function getTopic( $id )
  {
    // Get all the info for a particular topic
    // Returns an array with all the info

    $conn = parent::connect();

    $sql = "SELECT
            *
            FROM
            topics
            WHERE
            id = '$id'";

    try
    {
      $info = $conn->query( $sql );
      
      $topic = $info->fetch( PDO::FETCH_ASSOC );

      parent::disconnect();

      return $topic;
    }
    catch ( PDOException $e )
    {
      parent::disconnect();
      die( "Query failed: " . $e-getMessage() );
    }

  }
}

?>
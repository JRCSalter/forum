<?php

class Topic extends DataObject
// Defines all the methods for Topics
{
  protected $data = array(
                           "id"       => "",
                           "title"    => "",
                           "author"   => "",
                           "postTime" => ""
                         );

  public function getTopics()
  // Retrieve an array of all topics and the associated data
  {
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

      foreach ( $st->fetchAll() as $row )
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
  } // end getTopics()

  public function getTopic( $id )
  // Get all the info for a particular topic
  // Returns an array with all the info
  {
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
  } // end getTopic()

  public function getTopicByTitle( $title )
  // Get all the info for a particular topic from the title
  // Returns an array with all the info
  {
    $conn = parent::connect();

    $sql = "SELECT
            *
            FROM
            topics
            WHERE
            title = '$title'";

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
  } // end getTopicByTitle()

  public function insertTopic()
  // insert a new topic
  {
    $conn = parent::connect();

    $sql = "INSERT INTO
            topics
            (
              title,
              author
            )
            VALUES
            (
              :title,
              :author
            )";

    try
    {
      $topic = $conn->prepare( $sql );

      $topic->bindValue( ":title",  $this->data[ "title"  ] );
      $topic->bindValue( ":author", $this->data[ "author" ] );

      $topic->execute();

      parent::disconnect();
    }
    catch( PDOException $e )
    {
      parent::disconnect();

      die( "Query failed: " . $e->getMessage() );
    }
  }
}

?>

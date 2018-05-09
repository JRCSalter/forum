<?php

class Post extends DataObject
{
  protected $data = array(
                           "id"       => "",
                           "content"  => "",
                           "author"   => "",
                           "topic"    => "",
                           "postTime" => ""
                         );


  public function getPosts()
  {
    // Retrieve an array of all posts and the associated data

    $conn = parent::connect();

    $sql  = "SELECT
             *
             FROM
             posts";

    try
    {
      $st = $conn->query( $sql );

      foreach ($st->fetchAll() as $row)
      {
        $posts[] = new Post( $row );
      }

      parent::disconnect();

      return $posts;
    }
    catch( PDOException $e )
    {
      parent::disconnect();
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function getThread( $id )
  {
    // Returns an array of all posts under one topic

    $conn = parent::connect();

    $sql = "SELECT
            *
            FROM
            posts
            WHERE
            topic = :id
            ORDER BY
            postTime";

    try
    {
      $info = $conn->prepare( $sql );

      $info->bindValue( ":id", $id, PDO::PARAM_STR );

      $info->execute();

      $thread = $info->fetchAll( PDO::FETCH_ASSOC );

      parent::disconnect();

      return $thread;
    }
    catch( PDOException $e )
    {
      parent::disconnect();
      die( "Query failed: " . $e->getMessage() );
    }
  }
}

?>
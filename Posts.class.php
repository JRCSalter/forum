<?php

class Post extends DataObject
// handles the posts and comments
{
  protected $data = array(
                           "id"       => "",
                           "content"  => "",
                           "author"   => "",
                           "topic"    => "",
                           "postTime" => ""
                         );

  public function getPosts()
  // Retrieve an array of all posts and the associated data
  {
    $conn = parent::connect();

    $sql  = "SELECT
             *
             FROM
             posts";

    try
    {
      $st = $conn->query( $sql );

      foreach ( $st->fetchAll() as $row )
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
  } // end getPosts()

  public function getThread( $id )
  // Returns an array of all posts under one topic
  // $id is the id of the relevant topic
  {
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

      foreach ( $info->fetchAll() as $row )
      {
        $thread[] = new Post( $row );
      }

      parent::disconnect();

      return $thread;
    }
    catch( PDOException $e )
    {
      parent::disconnect();

      die( "Query failed: " . $e->getMessage() );
    }
  } // end getThread()

  public function insertPost()
  // Inserts a post into the database
  {
    $conn = parent::connect();

    $sql = "INSERT INTO
            posts
            (
              content,
              author,
              topic
            )
            VALUES
            (
              :content,
              :author,
              :topic
            )";

    try
    {
      $post = $conn->prepare( $sql );

      $post->bindValue( ':content', $this->data[ "content" ] );
      $post->bindValue( ':author',  $this->data[ "author"  ] );
      $post->bindValue( ':topic',   $this->data[ "topic"   ] );

      $post->execute();

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

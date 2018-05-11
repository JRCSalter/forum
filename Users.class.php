<?php
// rfdsevbf
class User extends DataObject
{
  protected $data = array(
                           "id"       => "",
                           "name"     => "",
                           "age"      => "",
                           "dob"      => "",
                           "password" => "",
                           "joined"   => "",
                         );


  public function getUsers()
  {
    // Retrieve an array of all users and the associated data

    $conn = parent::connect();

    $sql  = "SELECT
             *
             FROM
             users";

    try
    {
      $st = $conn->query( $sql );

      foreach ($st->fetchAll() as $row)
      {
        $users[] = new User( $row );
      }

      parent::disconnect();

      return $users;
    }
    catch( PDOException $e )
    {
      parent::disconnect();
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function getUser( $id )
  {
    // Gets the information of a particular user from their ID
    // Returns an array with the info

    $conn = parent::connect();

    $sql = "SELECT
            *
            FROM
            users
            WHERE
            id = '$id'";

    try
    {
      $user = $conn->query( $sql );

      $info = $user->fetch( PDO::FETCH_ASSOC );

      parent::disconnect();
      return $info;
    }
    catch( PDOException $e )
    {
      parent::disconnect();
      die( "Query Failed: " . $e->getMessage() );
    }
  }

  public function getUserByName( $name )
  {

    // Gets the information of a particular user from their ID
    // Returns an array with the info

    $conn = parent::connect();

    $sql = "SELECT
            *
            FROM
            users
            WHERE
            name = '$name'";

    try
    {
      $user = $conn->query( $sql );

      $info = $user->fetch( PDO::FETCH_ASSOC );

      parent::disconnect();
      return $info;
    }
    catch( PDOException $e )
    {
      parent::disconnect();
      die( "Query Failed: " . $e->getMessage() );
    }
  }

  public function insertUser()
  {
    // Adds user to database

    $conn = parent::connect();

    $sql = "INSERT INTO
            users
            (
              name,
              age,
              dob,
              password
            )
            VALUES
            (
              :name,
              :age,
              :dob,
              :password
            )";

    try
    {
      $user = $conn->prepare( $sql );

      $user->bindValue( ":name",     $this->data[ "name"     ] );
      $user->bindValue( ":age",      $this->data[ "age"      ] );
      $user->bindValue( ":dob",      $this->data[ "dob"      ] );
      $user->bindValue( ":password", $this->data[ "password" ] );

      $user->execute();

      parent::disconnect();

      ?>

      <h1>Welcome <?php echo $this->data[ "name" ] ?></h1>

      <p>You have succesfully signed up.</p>

      <a href='index.php'><button>Home</button></a>

      <?php
    }
    catch( PDOException $e )
    {
      parent::disconnect();

      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function isVerified( $name, $password )
  {
    // verify a user exists
    // Returns a boolean value

    $user     = User::getUserByName( $name );
    $storedPW = $user[ 'password'          ];

    return password_verify( $password, $storedPW );
  }
}

?>

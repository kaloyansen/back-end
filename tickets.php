<?php
    // Se connecter à la base de données
  include("db_connect.php");
 
  function getTicket($id=0)
  {
    echo('ticket');
    global $conn;
    $query = "SELECT * FROM postit";
    if($id != 0)
    {
      $query .= " WHERE id=".$id." LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }
  function getTickets()
  {
    global $conn;
    $query = "SELECT * FROM postit";
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }

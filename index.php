<?php
include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];
//  var_dump($_GET["id"]);
function getTicket($id=0)
{
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
function AddTicket()
{
  global $conn;
  $title = $_POST["title"];
  $body = $_POST["body"];
  $status = $_POST["status"];
  $actualposition = $_POST["ActualPosition"];
  $color = $_POST["color"];
  echo $query="INSERT INTO postit (title, body, status, ActualPosition, color) VALUES('".$title."', '".$body."', '".$status."', '".$actualposition."', '".$color."')";
  if(mysqli_query($conn, $query))
  {
    $response=array(
      'status' => 1,
      'status_message' =>'Ticket ajoute avec succes.'
    );
  }
  else
  {
    $response=array(
      'status' => 0,
      'status_message' =>'ERREUR!.'. mysqli_error($conn)
    );
  }
  header('Content-Type: application/json');
  echo json_encode($response);
}
function updateTicket($id)
{
    global $conn;
    $_PUT = array();
    parse_str(file_get_contents('php://input'), $_PUT);
    $title = $_PUT["title"];
    $body = $_PUT["body"];
    $actualPosition = $_PUT["actualPosition"];
    $status = $_PUT["status"];
    $color = $_POST["color"];
    $query="UPDATE postit SET title='".$title."', body='".$body."', actualPosition='".$actualPosition."', status='".$status."', color='".$color."' WHERE id=".$id;

    if(mysqli_query($conn, $query))
    {
        $response=array(
            'status' => 1,
            'status_message' =>'Postit mis a jour avec succes.'
        );
    }
    else
    {
        $response=array(
            'status' => 0,
            'status_message' =>'Echec de la mise a jour du postit. '. mysqli_error($conn)
        );

    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

switch($request_method)
{
  case 'GET':
    if(!empty($_GET["id"]))
    {
      // Récupérer un seul ticket
      $id = intval($_GET["id"]);
      getTicket($id);
    }
    else
    {
      // Récupérer tous les tickets
      getTickets();
    }
    break;
  case 'POST':
      // Ajouter un ticket
      AddTicket();
      break;
  case 'PUT':
        // Modifier un ticket
        $id = intval($_GET["id"]);
        updateTicket($id);
      break;
  default:
    // Requête invalide
    header("HTTP/1.0 405 Method Not Allowed");
    break;
}

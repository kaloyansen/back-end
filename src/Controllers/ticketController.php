<?php
// Se connecter à la base de données
include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];
switch($request_method)
{
    case 'GET':
        if($id)
        {
            // Récupérer un seul produit
            getTicket($id);
        }
        else
        {
            // Récupérer tous les produits
            getTickets();
        }
        break;
    case 'PUT':
        // Modifier un produit
        updateTicket($id);
        break;
    case 'POST':
        // Ajouter un produit
        addTicket();
        break;
    case 'DELETE':
        // Supprimer un produit
        deleteTicket($id);
        break;
    default:
        // Requête invalide
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getTickets()
{
    global $conn;
    $query = "SELECT * FROM postit";
    $response = [];
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response,JSON_PRETTY_PRINT);
}

function getTicket($id=0)
{
    global $conn;
    $query = "SELECT * FROM postit";
    if($id != 0)
    {
        $query .= " WHERE id=".$id." LIMIT 1";
    }
    $response = [];
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

function addTicket()
{
    global $conn;
    $title = $_POST["title"];
    $body = $_POST["body"];
    $actualPosition = $_POST["actualPosition"];
    $status = $_POST["status"];
    $color = $_POST["color"];
    echo $query="INSERT INTO postit(title, body, ActualPosition, status, color) VALUES('".$title."', '".$body."', '".$actualPosition."', '".$status."', '".$color."')";
    if(mysqli_query($conn, $query))
    {
        $response=array(
            'status' => 1,
            'status_message' =>'Postit ajout� avec succ�s.'
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

function updateTicket($id=0) {
    global $conn;
    $_PUT = array();
    parse_str(file_get_contents('php://input'), $_PUT);
    $title = $_PUT["title"];
    $body = $_PUT["body"];
    $actualPosition = $_PUT["actualPosition"];
    $status = $_PUT["status"];
    $color = $_PUT["color"];
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

function deleteTicket($id)
{
    global $conn;
    $query = "DELETE FROM postit WHERE id=".$id;
    if(mysqli_query($conn, $query))
    {
        $response=array(
            'status' => 1,
            'status_message' =>'Produit supprime avec succes.'
        );
    }
    else
    {
        $response=array(
            'status' => 0,
            'status_message' =>'La suppression du produit a echoue. '. mysqli_error($conn)
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

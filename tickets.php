<?php

// Connect to database
include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];

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
    echo json_encode($response);
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
    $query = "UPDATE postit
                SET title = '" .$title . "',
                    body = '" .$body . "', 
                    actualPosition = '" .$actualPosition . "',
                    status = '" .$status . "',
                    color = '" .$color . "',
                WHERE id = '" .$color . "';";

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
switch($request_method)
{

    case 'GET':
        // Retrive Products
        if(!empty($_GET["id"]))
        {
            $id=intval($_GET["id"]);
            getTickets($id);
        }
        else
        {
            getTickets();
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;

    case 'POST':
        // Ajouter un produit
        addTicket();
        break;

    case 'PUT':
        // Modifier un produit
        $id = intval($_GET["id"]);
        updateTicket($id);
        break;

    case 'DELETE':
        // Supprimer un produit
        $id = intval($_GET["id"]);
        deleteTicket($id);
        break;

}

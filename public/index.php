<?php
//Name: Oconer, Donell Carl G.    Year & Section: BS INFOTECH 4A

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../src/vendor/autoload.php';

$app = new \Slim\App;

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

// insert information to database *post request*
// url: http://localhost/api/public/postName 
// example: putting raw json on postman body 
/*
    {
        "lname":"Oconer",
        "fname":"Donell"
    }
*/
$app->post('/postName', function (Request $request, Response $response, array $args) use ($servername, $username, $password, $dbname) {
    $data = json_decode($request->getBody());
    $fname = $data->fname;
    $lname = $data->lname;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO names (fname, lname) VALUES (:fname, :lname)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "data" => $data)));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }

    $conn = null;
});


// getting list of data from database
// url: http://localhost/api/public/getName *post request*

$app->get('/getName', function (Request $request, Response $response, array $args) use ($servername, $username, $password, $dbname) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM names");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            $response->getBody()->write(json_encode(array("status" => "success", "data" => $data)));
        } else {
            $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
        }
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }

    $conn = null;
});

// getting list of data from database
// url: http://localhost/api/public/delName/1 *del request*

$app->delete('/delName/{id}', function (Request $request, Response $response, array $args) use ($servername, $username, $password, $dbname) {
    $id = $args['id'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM names WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "message" => "Data Successfully deleted")));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }

    $conn = null;
});

// update info in database
// url: http://localhost/api/public/updateName/3 *put request*
// example: putting raw json on postman body  to update
/*
    {
        "lname":"Oconer",
        "fname":"Donell Carl"
    }
*/
$app->put('/updateName/{id}', function (Request $request, Response $response, array $args) use ($servername, $username, $password, $dbname) {
    $id = $args['id'];
    $data = json_decode($request->getBody());
    $fname = $data->fname;
    $lname = $data->lname;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE names SET fname = :fname, lname = :lname WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->execute();

        $response->getBody()->write(json_encode(array("status" => "success", "message" => "Data updated")));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }

    $conn = null;
});

$app->run();

<?php

require_once(__DIR__ . "/mysqli.php");

use App\Amasty\Models\Response;
use App\Amasty\Models\RequestResponse;

$uriPath = parse_url($_SERVER['REQUEST_URI']);
$uriExpression = explode('/', $uriPath['path']);
$requestID = (int) (isset($uriExpression[2]) ? $uriExpression[2] : FALSE);

$response = new Response($db);
$requestResponse = new RequestResponse($db);

$responseID = $requestResponse->getResponseID($requestID);
$loadedResponse = $response->load($responseID);

var_dump($requestID);
var_dump($responseID);
var_dump($loadedResponse);

if($_POST) {
  $responseID = $response->create($_POST['responseDescription']);
  $requestResponse->add($requestID, $responseID);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/styles.css">
</head>

<body>

<div>
    <?php $action = ($requestID) ? "/request/$requestID/response": "/response"; ?>
    <form action=<?php echo $action; ?> method="POST">
        <!-- <label for="responseDescription">Response</label><br> -->
        <textarea type="text" name="responseDescription" rows=10 cols=50 maxlength="250"><?php echo $loadedResponse['description'] ?? ''; ?></textarea><br>
        <input type="submit">
    </form>
</div>

</body>

</html>

<?php

#require_once('mysqli.php');
require_once(__DIR__ . "/mysqli.php");

use App\Amasty\Models\Request;
use App\Amasty\RequestStatus;

$statuses = RequestStatus::STATUSES;

$uriPath = parse_url($_SERVER['REQUEST_URI']);
$uriExpression = explode('/', $uriPath['path']);
$requestID = (int) (isset($uriExpression[2]) ? $uriExpression[2] : FALSE);

$request = new Request($db);

if($requestID) {
    $loaded = $request->load2($requestID)[0] ?? FALSE;
    var_dump($loaded);
} elseif (isset($_POST['description']) && $_POST['statuses']) {
  $request->createRequest($_POST['description'], $_POST['statuses']);
  // Source - https://stackoverflow.com/a/29191719
// Posted by ThehalfHeart, modified by community. See post 'Timeline' for change history
// Retrieved 2026-02-22, License - CC BY-SA 3.0

    header('Location: http://localhost/requests');
    exit();

}

if(isset($_POST)) {

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
     <form action="/request" method="POST">
         <label for="title">Title</label>
         <input type="text" name="title" value="<?php echo $loaded['title'] ?? ''; ?>"><br>
         <label for="description">Description</label>
         <textarea type="text" name="description" rows=10 maxlength="250">
              <?php echo $loaded['description'] ?? ''; ?>
         </textarea><br>
         <label for="statuses">Status</label>
         <select name="statuses" id="status-select">
           <?php foreach($statuses as $id => $status): ?>
              <option value="<?php echo $id; ?>" <?php echo (isset($loaded['status']) && $loaded['status'] === $id ) ? "selected" : ''?>><?php echo $status; ?></option>
           <?php endforeach; ?>
         </select>
         <input type="submit">
     </form>
 </div>

 </body>

 </html>

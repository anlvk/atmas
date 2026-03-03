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
    $loaded = $request->load($requestID)[0] ?? FALSE;

}

if($_POST) {
  if($requestID) {
    $request->update($requestID, $_POST['description'], $_POST['title'], $_POST['statuses']);
  } else {
    $request->create($_POST['description'], $_POST['title'], $_POST['statuses']);
    // Source - https://stackoverflow.com/a/29191719
  // Posted by ThehalfHeart, modified by community. See post 'Timeline' for change history
  // Retrieved 2026-02-22, License - CC BY-SA 3.0
    header('Location: http://localhost/requests');
    exit();

  }
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
     <div>
       <h2> Request </h2>
         <?php $action = ($requestID) ? "/request/$requestID": "/request"; ?>
         <form action=<?php echo $action; ?> method="POST">
             <label for="title">Title</label>
             <input type="text" name="title" value="<?php echo $loaded['title'] ?? ''; ?>"><br>
             <label for="description">Description</label><br>
             <textarea type="text" name="description" rows=10 cols=50 maxlength="250"><?php echo $loaded['description'] ?? ''; ?></textarea><br>
             <label for="statuses">Status</label>
             <select name="statuses" id="status-select">
               <?php foreach($statuses as $id => $status): ?>
                  <option value="<?php echo $id; ?>" <?php echo (isset($loaded['status']) && $loaded['status'] === $id ) ? "selected" : ''?>><?php echo $status; ?></option>
               <?php endforeach; ?>
             </select>
             <input type="submit">
         </form>
    </div>

     <br><br>
     <div>
       <?php if($requestID): ?>
         <h2> Response </h2>
       <?php
           include_once('response.php');
             endif; ?>
     </div>
 </div>

 </body>

 </html>

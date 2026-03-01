<?php

require_once('mysqli.php');

use App\Amasty\Models\Request;
use App\Amasty\RequestStatus;

$request = new Request($db);
$tasks = $request->getAllRequests();


// Filtering
if(isset($_GET) && isset($_GET['filtering']) && $_GET['filtering'] != "-") {
  $tasks = array_filter($tasks, function($task){
    return $task['status'] === (int) $_GET['filtering'];
  });
}

// Sorting
$column = 'task_id';
if(isset($_GET) && isset($_GET['sorting'])) {
    $column = match(strtolower($_GET['sorting'])) {
      'id' => $column = 'task_id',
      'status' => $column = 'status',
      'created date' => 'created_date',
    };
}

// Order
$sortOrder = SORT_ASC;

if(isset($_GET) && isset($_GET['sort-order'])) {
    if($_GET['sort-order'] != 'ASC') {
        $sortOrder = SORT_DESC;
    }
}

$columns = array_column($tasks, $column);
$sorted = array_multisort($columns, $sortOrder, $tasks);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/styles.css">
</head>

<body>
    <div>
      <br>
      <form action="/requests" method="GET">
        <lable for="filtering">Filtering</label>
        <select id="filtering" name="filtering">
          <option value="-">-</option>
          <?php foreach(RequestStatus::STATUSES as $id => $status): ?>
            <option value=<?php echo $id; ?>><?php echo $status;?></option>
          <?php endforeach; ?>
        </select>

          <lable for="sorting">Sorting</label>
          <select id="sorting" name="sorting">
              <option name="id">ID</option>
              <option name="created">Created date</option>
              <option name="status">Status</option>
          </select>
          <lable for="sorting-asc-desc">ASC/DESC</label>
          <select id="sorting-asc-desc" name="sort-order">
              <option>ASC</option>
              <option>DESC</option>
          </select>

          <input type="submit" value="Submit">
      </form>
      <br>
      <br>

      <table id="requests" class="truncate multi-line-truncate">
        <tr>
          <th class="request-id sortable">Task ID</th>
          <th class="created sortable">Created date</th>
          <th class="updated sortable">Updated date</th>
          <th class="status sortable">Status</th>
          <th class="title sortable">Title</th>
          <th class="multi-line-truncate">Description</th>
          <th class="action">Action</th>
        </tr>
    <?php

      foreach($tasks as $task) {
        include("templates/task.html");
      }
    ?>
      </table>

      <div>
        <br>
        <?php
            include_once("./request.php");
        ?>
      </div>
    </div>
</body>

</html>

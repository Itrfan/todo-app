<?php 
 //put backend code before rendering all the html elements

 // connect to database
 // 1. database info

 session_start();

$host = "127.0.0.1";
$database_name = "todo_app";
$database_user = "root";
$database_password = "";


// 2. connect PHP with the MySQL database
//PDO (PHP Database Object)
$database = new PDO("mysql:host=$host;dbname=$database_name", 
$database_user, 
$database_password);

// 3. get the studentes data from the database
// 3.1 - recipe(sql command)
$sql = "SELECT * FROM todos";
// 3.2 - prepare your material(prepare SQL query)
$query = $database->prepare($sql); // 3.3 - cook it (execute the SQL query)
$query->execute(); // 3.4 - eat (fetch all the results from the query) 
$todos = $query->fetchAll(); ?>

<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto 30px auto"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <?php if ( isset( $_SESSION["user"] ) ) : ?>
        <div>
          <a href="logout.php"></a>
        </div>
        <?php else: ?>
        <!-- If user is not logged in -->
        <div>
          <a href="login.php">Login</a>
          <a href="signup.php">Sign Up</a>
        </div>
        <?php endif; ?>
        <?php if ( isset( $_SESSION["user"] ) ) : ?>
        <!-- tasks  -->
        <?php foreach ($todos as $index =>
        $todo) { ?>
        <ul class="list-group">
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
              <form method="POST" action="update_task.php">
                <!-- hidden input is to pass required data to the backend -->
                <input type="hidden" name="label_id" value="<?php echo $todo["id"]; ?>"/>
                <input type="hidden" name="completed" value="<?php echo $todo["completed"]; ?>"/>
                <?php if ( $todo["completed"] == 1 ) { ?>
                <button class="btn btn-sm btn-success">
                  <i class="bi bi-check-square"></i>
                </button>
                <span class="ms-2 text-decoration-line-through"
                  ><?php echo $todo["label"];?>
                </span>
                <?php } else { ?>
                <button class="btn btn-sm btn-light">
                  <i class="bi bi-square"></i>
                </button>
                <span class="ms-2"><?php echo $todo["label"];?> </span>
                <?php } ?>
              </form>
            </div>
            <!-- delete button  -->
            <form method="POST" action="delete_task.php">
              <!-- hidden input is to pass required data to the backend -->
              <input type="hidden" name="label_id" value="<?php echo $todo["id"]; ?>"
              />
              <button class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
              </button>
            </form>
            <!-- delete button  -->
          </li>
        </ul>
        <!-- tasks  -->
        <?php } ?>
        <!-- add tasks  -->
        <div class="mt-4">
          <form
            method="POST"
            action="add_task.php"
            class="d-flex justify-content-between align-items-center"
          >
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="label_name"
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
        <!-- add tasks  -->
        <?php endif; ?>
      </div>
    </div>

    <div class="mt-1 d-flex justify-content-center">
      <?php if ( isset( $_SESSION["user"] ) ) : ?>
        <div>
          <a href="logout.php">Logout</a>
        </div>
      <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

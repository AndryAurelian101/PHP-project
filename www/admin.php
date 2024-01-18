<?php
session_start();

include "db_connect.php";

// Check if the user is authenticated and is an admin
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true || $_SESSION['role'] !== 'admin') {
    // Redirect to login page or show an error
    header('Location: log_in_site.php');
    exit();
}

// Replace these with your database credentials
$hostname = "host";
$username = "user1";
$password = "Password1";
$database = "library_database";

// Create a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get all tables in the database
function getTables($conn) {
    $tables = array();
    $result = $conn->query("SHOW TABLES");

    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    return $tables;
}

// Function to fetch all rows from a table
function getTableData($conn, $tableName) {
    $data = array();
    $result = $conn->query("SELECT * FROM $tableName");

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

// Function to delete a row from a table
function deleteTableRow($conn, $tableName, $primaryKey, $id) {
    // Get the primary key column dynamically
    $result = $conn->query("SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'");
    $row = $result->fetch_assoc();
    $primaryKey = $row['Column_name'];
    
    $stmt = $conn->prepare("DELETE FROM $tableName WHERE $primaryKey = ?");
    if (!$stmt) {
        die("Error in prepare: " . $conn->error);
    }

    $stmt->bind_param("s", $id);  // Use "s" for string if the ID is a string, "i" for integer
    $stmt->execute();
    if ($stmt->error) {
        die("Error in execute: " . $stmt->error);
    }

    $stmt->close();
}

function deleteWishlistRow($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE id = ?");
    if (!$stmt) {
        die("Error in prepare: " . $conn->error);
    }

    $stmt->bind_param("i", $id);  // Assuming 'id' is an integer, adjust accordingly
    $stmt->execute();
    if ($stmt->error) {
        die("Error in execute: " . $stmt->error);
    }

    $stmt->close();
}

// Check if a table is specified for modification or deletion
if (isset($_GET['table'])) {
    $selectedTable = $_GET['table'];

    if ($selectedTable === 'clients_info'){
        // Check if an ID is specified for deletion
        if (isset($_GET['delete']) && isset($_GET['user_id'])) {
            $deleteId = $_GET['user_id'];
            $primaryKey = 'user_id';
            deleteTableRow($conn, $selectedTable, $primaryKey, $deleteId);
        }   
    
    } elseif ($selectedTable === 'wishlist') {
            if (isset($_GET['delete']) && isset($_GET['id'])) {
            $deleteId = $_GET['id'];
            $primaryKey = 'id';
            deleteTableRow($conn, $selectedTable, $primaryKey, $deleteId);
            deleteWishlistRow($conn, $deleteId);
            }
        }


    // Check if a form is submitted for modification or addition
    if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['submit'])) {
    $table = $_GET['table'];

        // Check if the form is for adding a new user
        if ($table === 'clients_info') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // Prepare and execute the SQL query to insert the new user into clients_info table
            $stmt = $conn->prepare("INSERT INTO clients_info (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $password, $role);

            // Execute the statement
            $stmt->execute();

            // Close the statement
            $stmt->close();

            // Redirect to avoid form resubmission
            header("Location: admin.php?table=$table");
            exit();
        }
    }

    // Fetch data from the selected table
    $tableData = getTableData($conn, $selectedTable);

    // Fetch column names (keys) from the first row if data is available
    $columnNames = !empty($tableData) ? array_keys($tableData[0]) : array();
}

// Get all tables in the database
$tables = getTables($conn);

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="img/book.ico">
    <link rel="stylesheet" href="form_style.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .logout-link {
            position: fixed;
            top: 10px;
            right: 10px;
            color: white;
            text-decoration: none;
        }

        .add-form {
            margin: 20px;
        }

        .add-form label, .add-form input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Admin Panel</h2>
    <a class="logout-link" href="logout.php">Logout</a>

    <h3>Tables</h3>
    <ul>
        <?php foreach ($tables as $table): ?>
            <li><a href="admin.php?table=<?php echo $table; ?>"><?php echo $table; ?></a></li>
        <?php endforeach; ?>
    </ul>

    <?php if (isset($selectedTable)): ?>
        <h3><?php echo $selectedTable; ?></h3>

        <?php if (!empty($columnNames)): ?>
            <table>
                <tr>
                    <?php foreach ($columnNames as $columnName): ?>
                        <th><?php echo $columnName; ?></th>
                    <?php endforeach; ?>
                    <th>Actions</th>
                </tr>

                <?php foreach ($tableData as $row): ?>
                    <tr>
                        <?php foreach ($row as $key => $value): ?>
                            <td><?php echo $value; ?></td>
                        <?php endforeach; ?>
                        <td>
                            <?php
                            $deleteColumnName = reset($columnNames); // Get the first column name
                            $deleteId = $row[$deleteColumnName]; // Get the corresponding value
                            ?>
                            <a href="admin.php?table=<?php echo $selectedTable; ?>&delete=true&<?php echo urlencode($deleteColumnName); ?>=<?php echo urlencode($deleteId); ?>">Delete</a>
                            <!-- Add modify link or form here -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- Add form or modify links here -->
            <div class="add-form">
                <h4>Add New User</h4>
                <form method="post" action="admin.php?table=clients_info">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    
                    <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="user">User</option>
                    </select>
                    
                    <input type="submit" name="submit" value="Add User">
                </form>
            </div>
        <?php else: ?>
            <p>No columns found for the selected table.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>

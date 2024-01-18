<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirecteaza catre pagina de introducere a adresei de e-mail
    header('Location: log_in_site.php');
    exit();
}
$userId = $_SESSION['id'];
$api_key = 'AIzaSyAsTDXHjr8CvAfVgndz0Cs4I1kbJEr95Sk';

// Replace these with your database credentials
$hostname = "host";
$username = "user1";
$password = "Password1";
$database = "library_database";

// Create a database connection
$db = new mysqli($hostname, $username, $password, $database);
// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

function get_books($query) {
    global $api_key;
    $url = 'https://www.googleapis.com/books/v1/volumes?q=' . urlencode($query) . '&key=' . $api_key;
    $response = file_get_contents($url);
    return json_decode($response, true);
}

// Handle adding books to wishlist
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['book_id']) && isset($_GET['title'])) {
    $bookId = $_GET['book_id'];
    $title = $_GET['title'];
    $userId = $_SESSION['id'];
    // Prepare and execute the SQL query to insert the book into the wishlist
    $stmt = $db->prepare("INSERT INTO wishlist (user_id, book_id, title) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $bookId, $title);

    // Execute the statement
    $stmt->execute();
        
    // Close the statement
    $stmt->close();
}


// Handle removing books from wishlist
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['wishlist_id'])) {
    $wishlistId = $_GET['wishlist_id'];

    // Prepare and execute the SQL query to remove the book from the wishlist
    $stmt = $db->prepare("DELETE FROM wishlist WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $wishlistId, $userId);
    
    // Execute the statement
    $stmt->execute();
    
    // Close the statement
    $stmt->close();
}

// Handle book search
if (isset($_POST['search'])) {
    $query = $_POST['query'];
    $books = get_books($query);

    // Store search results in a session variable
    $_SESSION['search_results'] = $books;
} elseif (isset($_SESSION['search_results'])) {
    // If there are stored search results, use them
    $books = $_SESSION['search_results'];
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="img/book.ico">
    <link rel="stylesheet" href="form_style.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
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
        
    </style>
</head>
<body>
    <div id="book_table">
    <h2>Book Search</h2>
    <form method="post" action="">
        <label for="query">Search:</label>
        <input type="text" id="query" name="query" required>
        <input type="submit" name="search" value="Search">
    </form>

    <?php if (isset($books) && isset($books['items'])): ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php foreach ($books['items'] as $item): ?>
                <?php
                $title = $item['volumeInfo']['title'];
                
                // Check if 'authors' key exists and is an array
                $authors = isset($item['volumeInfo']['authors']) && is_array($item['volumeInfo']['authors'])
                    ? implode(', ', $item['volumeInfo']['authors'])
                    : 'N/A';

                $description = isset($item['volumeInfo']['description']) ? $item['volumeInfo']['description'] : 'N/A';
                $bookId = $item['id'];
                ?>
                <tr>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $authors; ?></td>
                    <td><?php echo $description; ?></td>
                    <td>
                        <a href="?action=add&book_id=<?php echo $bookId; ?>&title=<?php echo urlencode($title); ?>">Add to Wishlist</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php elseif (isset($books['error'])): ?>
        <p>Error: <?php echo $books['error']['message']; ?></p>
    <?php endif; ?>
    <a class="logout-link" href="logout.php">Logout</a>

    <h2>Wishlist</h2>
    <?php
    // Fetch wishlist items
    $stmt = $db->prepare("SELECT * FROM wishlist WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    
    // Execute the statement
    $stmt->execute();

    // Get the result
    $wishlistResult = $stmt->get_result();
    
    if ($wishlistResult->num_rows > 0): ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $wishlistResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td>
                        <a href="?action=remove&wishlist_id=<?php echo $row['id']; ?>">Remove from Wishlist</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Your wishlist is empty.</p>
    <?php endif; 
    $stmt->close(); ?>
    <br>
    <br>
    </div>
    <footer>
        <p>Site created by <a href="https://github.com/AndryAurelian101/PHP-project.git">Andry101</a>
        </p>
        <p>Student at the Faculty of Mathematics and Informatics Bucharest.
        </p>
        <p>Contact me <a href = "form.php">here</a></p>
    </footer>
</body>
</html>

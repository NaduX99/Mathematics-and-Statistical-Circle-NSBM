
<?php

/**
 * Creates and returns a database connection object.
 * @return mysqli|null Returns the connection object on success, or null on failure.
 */

function db_connect() {

    static $conn;

    if ($conn === null) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mascwebsite";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    return $conn;
}

/**
 * Fetches all articles from the news table, ordered by publish date descending.
 * @return array An array of articles.
 */

function get_all_articles() {
    $conn = db_connect();
    $articles = [];
    
    $sql = "SELECT * FROM news ORDER BY publish_date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $articles = $result->fetch_all(MYSQLI_ASSOC);
    }
    
    return $articles;
}

/**
 * Fetches a single article by its ID.
 * @param int $id The ID of the article to fetch.
 * @return array|null The article data as an array, or null if not found.
 */

function get_article_by_id($id) {
    $conn = db_connect();
    $id = intval($id); 

    $sql = "SELECT * FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $article = $result->fetch_assoc();
    
    $stmt->close();
    return $article;
}

/**
 * Saves an article to the database (handles both INSERT and UPDATE).
 * @param array $data The article data from the $_POST superglobal.
 * @return bool True on success, false on failure.
 */

function save_article($data) {
    $conn = db_connect();

    $title = mysqli_real_escape_string($conn, $data['title']);
    $category = mysqli_real_escape_string($conn, $data['category']);
    $author = mysqli_real_escape_string($conn, $data['author']);
    $publish_date = mysqli_real_escape_string($conn, $data['publish_date']);
    $image = mysqli_real_escape_string($conn, $data['image']);
    $source_link = mysqli_real_escape_string($conn, $data['source_link']);
    $description = mysqli_real_escape_string($conn, $data['description']);
    $full_content = mysqli_real_escape_string($conn, $data['full_content']);
    
    $article_id = isset($data['id']) ? intval($data['id']) : null;

    if ($article_id) {
        $sql = "UPDATE news SET title = ?, category = ?, author = ?, publish_date = ?, image = ?, source_link = ?, description = ?, full_content = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $title, $category, $author, $publish_date, $image, $source_link, $description, $full_content, $article_id);
    } else {
        $sql = "INSERT INTO news (title, category, author, publish_date, image, source_link, description, full_content) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $title, $category, $author, $publish_date, $image, $source_link, $description, $full_content);
    }

    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

/**
 * Deletes an article from the database by its ID.
 * @param int $id The ID of the article to delete.
 * @return bool True on success, false on failure.
 */

function delete_article($id) {
    $conn = db_connect();
    $id = intval($id);

    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

?>

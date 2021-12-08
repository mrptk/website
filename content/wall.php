<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Tablica</title>
    </head>
    <body>
        <div class="wall">
            <h1>***************</h1>
            <?php
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

$db = mysqli_connect('localhost', 'root', '', 'projekt');

$query = "SELECT * FROM posts ORDER BY id DESC;";
$result = mysqli_query($db, $query);

while ($post = mysqli_fetch_assoc($result)) {
    $user_id = $post["user_id"];
    $post_title = $post["title"];
    $post_content = $post["content"];
    $user_query = "SELECT * FROM users WHERE id='$user_id'";
    $result_user_query = mysqli_query($db, $user_query);
    $user = mysqli_fetch_assoc($result_user_query);
    $username = $user["username"];
    
    echo "<h5>$post_title</h5>
        <p>$post_content</p>
        <h6>napisał $username</h6>
        <h1>***************</h1>";
}
            ?>
        </div>
    </body>
</html>
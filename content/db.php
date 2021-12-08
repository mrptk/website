<?php

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

session_start();

$username = "";
$email = "";
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'projekt');


if (isset($_POST['register_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($db, $_POST['password_confirm']);

    if (empty($email)) { 
        array_push($errors, "Proszę podać adres email!"); 
    }
    if (empty($username)) { 
        array_push($errors, "Proszę podać nazwę użytkownika!"); 
    }
    if (empty($password)) { 
        array_push($errors, "Proszę podać hasło!"); 
    }
    if ($password != $password_confirm) { 
        array_push($errors, "Hasła się nie zgadzają!"); 
    }


    $user_exists_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_exists_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Nazwa użytkownika zajęta!");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Istnieje już konto powiązane z podanym adresem email!");
        }
    }

    if (count($errors) == 0) {
        $password_encrypted = md5($password);

        $query = "INSERT INTO users (email, username, password) VALUES('$email', '$username', '$password_encrypted')";
        mysqli_query($db, $query);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Miło Cię poznać, $username!";

        array_push($errors, $_SESSION['success']);
    }
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Podaj nazwę użytkownika!");
    }
    if (empty($password)) {
        array_push($errors, "Podaj hasło!");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password';";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            array_push($errors, "Witaj, $username");
        } else {
            array_push($errors, "Nie znamy się jeszcze, albo podałeś złe hasło...");
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: goodbye.html');
}

if (isset($_POST['send'])) {
    $title = mysqli_real_escape_string($db, $_POST['post_title']);
    $content = mysqli_real_escape_string($db, $_POST['post']);
    $username = mysqli_real_escape_string($db, $_SESSION['username']);

    console_log($title);
    console_log($content);
    console_log($username);

    if (empty($title)) {
        array_push($errors, "Nadaj tytuł!");
    }
    if (empty($content)) {
        array_push($errors, "Post jest pusty!");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username';";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            $user_id = mysqli_fetch_assoc($result);
            $user_id = $user_id["id"];

            $query = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id', '$title', '$content');";
            if (mysqli_query($db, $query)) {
                array_push($errors, "Dodano post!");
            } else {
                array_push($errors, "Nie dodano postu!");
            }            
        } else {
            console_log("USR not found");
        }
    }
}

?>
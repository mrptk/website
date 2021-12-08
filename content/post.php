<?php include('db.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Dodaj post</title>
</head>

<body>
<?php if (isset($_SESSION['username'])) : ?>
    <div class="post_block">
        <p><b>Wypowiedz się poniżej:</b></p>
        <form method="POST" action="post.php">
            Tytuł: <input type="text" name="post_title" /><br /><br />
            <textarea rows="8" cols="60" name="post"></textarea> <br /><br />
            <input class="button" type="submit" name="send" value="Publikuj" />
        </form>
    </div>
<?php
foreach ($errors as $error) :
echo "<p>$error</p>";
endforeach;
endif;
?>
<?php if (!isset($_SESSION['username'])) : ?>
    <p>Wypada się przywitać, zanim się coś powie...</p>
<?php endif; ?>
</body>

</html>
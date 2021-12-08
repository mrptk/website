<?php include('db.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />    
    <link rel="stylesheet" href="style.css" />
    <title>
        Login
    </title>
</head>
<body>
<?php if (!isset($_SESSION['username'])) : ?>
<form method="POST" action="login.php">
    <div class="login_block">
        <table>
            <tr><td>
                <form method="POST" action="login.php">
                <label for="login">Login:</label><br/>
                <input class="input" id="login" type="text" name="username"/></br></br>
            </td></tr>
            <tr><td>
                <label for="pass">Hasło:</label><br/>
                <input class="input" id="pass" type="password" name="password"/></br></br>
            </td></tr>
            <tr><td>
                <input class="button" type="submit" name="login_user" value="Zaloguj się"/>
            </td></tr>
        </table>
    </div>
</form>
<p>Jesteś tu pierwszy raz? <a href="registration.php">Przedstaw się!</a></p>
<?php
foreach ($errors as $error) :
echo "<p>$error</p>";
endforeach;
endif; 
?>
<?php if (isset($_SESSION['username'])) : ?>
<p>Już się przywitałeś, chcesz się pożegnać?</p></b>
<p><a href="db.php?logout='1'"> Wyloguj się</a></p>
<?php endif; ?>
</body>
</html>
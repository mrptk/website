<?php include('db.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css" />
    <title>
        Rejestracja
    </title>
</head>

<body>   
<form method="POST" action="registration.php">
    <div class="login_block">
        <table>
            <tr><td>
                <label for="pass">Email:</label><br/>
                <input class="input" id="email" type="email" name="email"/></br></br>
            </td></tr>
            <tr><td>
                <label for="login">Login:</label><br/>
                <input class="input" id="login" type="text" name="username"/></br></br>
            </td></tr>
            <tr><td>
                <label for="pass">Hasło:</label><br/>
                <input class="input" id="pass" type="password" name="password"/></br></br>
            </td></tr>
            <tr><td>
                <label for="pass_confirm">Potwierdź hasło:</label><br/>
                <input class="input" id="pass_confirm" type="password" name="password_confirm"/></br></br>
            </td></tr>
            <tr><td>
                <input class="button" type="submit" name="register_user" value="Zarejestruj się"/>
            </td></tr>
        </table>
    </div>
</form>
<?php
foreach ($errors as $error) :
echo "<p>$error</p>";
endforeach;
?>
</body>

</html>
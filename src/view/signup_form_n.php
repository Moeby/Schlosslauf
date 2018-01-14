<form action="controller/signup.php" method="post">
    <table>
        <p id="error"></p>
        <tr><th>Vorname:</th><th><input type="text" name="vorname"/></th></tr>
        <tr><th>Name:</th><th><input type="text" name="name"/></th></tr>
        <tr><th>Username:</th><th><input type="text" name="username" /></th></tr>
        <tr><th>Email:</th><th><input type="email" name="email"/></th></tr>
        <tr><th>Passwort:</th><th><input type="password" name="password" /></th></tr>
        <tr><th>Repeat Passwort:</th><th><input type="password" name="repPassword" /></th></tr>
        <tr><th></th><th><a href="index.php">Zurück zum Login</a></th></tr>
        <tr><th></th><th><input type="submit" value="Registrieren" /></th></tr>
    </table>
</form>
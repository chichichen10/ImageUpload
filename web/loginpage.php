<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="form" method="post" action="login.php">
    Username：<input type="text" name="id" required /> <br>
    Password：<input type="password" name="pwd" required /> <br>
    Input the folllowing numbers:<br>
    <img id="imgcode" src="captcha.php" /><br />
    <input type="text" name="check" pattern="[0-9]" required><br>
    <input type="submit" name="button" value="Login" />&nbsp;&nbsp;
</form>
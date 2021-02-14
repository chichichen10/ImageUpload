<!-- 設定網頁編碼為UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="form" method="post" action="login.php">
Username：<input type="text" name="id" /> <br>
Password：<input type="password" name="pwd" /> <br>
Input the folllowing numbers:<br>
<img id="imgcode" src="captcha.php" /><br />
<input type="text" name="check"><br>
<input type="submit" name="button" value="Login" />&nbsp;&nbsp;
<a href="captcha_index.php">captcha</a>
</form>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login form</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">    
</head>
<body>
    <header>
        <img src="Img/10.png" width = "129" height = "96" id = "img1">
        <span>ZAPP POLLS</span>
    </header>
 
<form action="" method="post" id = "group">
<table  id="tab"  cellpadding="12=" cellspacing="6">

<tr>
<td>
    <input type="text" class = "filter" id = "td1" required="true"/>
    <span class = "placeholder"> First Name </span>
</td>
<td>
    <input type="text" class = "filter" id = "td2" required="true"/>
    <span class = "placeholder"> Last Name </span>
</td>
</tr>

<tr>
<td>
    <input type="text" class = "filter" id = "td3" required="true"/>
    <span class = "placeholder1"> Email </span>
</td>
</tr>

<tr>
<td>
    <input type="password" class = "filter" id = "td3" required="true"/>
    <span class = "placeholder1"> Password </span>
</td>
</tr>

<tr>
<td><input type="submit" id="button" name="submit" value="Log In"/></td>
<td><a href = "register.php"><input type="submit" id="button1" name="submit" value="Sign Up"/></a></td>
</tr>

</table>
<div id = "text1"> By Signing in, you agree to Zapp's <a href="#" style = "color: red;">Terms of services.</a></div>
</form>

<br /><br /><br /><br /><br /><br /><br />

<footer>
 <span> All rights reserved copywright &copy2019 Zapp Polls inc.| Terms | Privacy | Brand </span>  
</footer>

</body>
</html>
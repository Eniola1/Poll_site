<?php

require_once 'app/init.php';

$pollsQuery = $db->query("
    SELECT id, question
    FROM polls 
    WHERE DATE (NOW()) BETWEEN starts AND ends
");

while($row = $pollsQuery->fetchObject())
{
    $polls[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <img src="Img/10.png" width = "129" height = "96" id = "img1">
        <span>
            <div>
            <ul id="navb">
            <li><a href = "index.php"><input type="submit" id="button1" value="Home"/></a></li>
            <li><a href = "#"><input type="submit" id="button2" value="Products"/></a></li>
            <li><a href = "#"><input type="submit" id="button3" value="Support"/></a></li>
            <li><a href = "#"><input type="submit" id="button4" value="Contacts"/></a></li>
            <li><a href = "#"><input type="submit" id="button5" value="Results"/></a></li>
            </ul>	
            </div>
        </span>
    </header>

    <?php if(!empty($polls)): ?>
        <ul>
            <?php foreach($polls as $poll): ?>
                <li><a href="poll.php?poll=<?php echo $poll->id;?>"><?php echo $poll->question; ?></a></li>
            <?php endforeach ?>
        </ul>

    <?php else: ?>
       <p> Sorry, no polls available right now. </p> 
    <?php endif;?>
</body>
</html>    
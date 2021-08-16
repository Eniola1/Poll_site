<?php 

require_once 'app/init.php';

if(isset($_POST['poll'], $_POST['choice']))
{
    $poll = $_POST['poll'];
    $choice = $_POST['choice'];
    $user = $_SESSION['user_id'];

    $checkQuery = "SELECT * from polls
    WHERE EXISTS(select id from polls where id = '$poll'
    AND DATE (NOW()) BETWEEN starts AND ends) 
    AND EXISTS(select id from polls_choices where id = '$choice' and poll = '$poll')
    AND NOT EXISTS(select id from poll_answers where user = '$user' and poll = '$poll')   
    LIMIT 1";

    $runCheck = mysqli_query($con, $checkQuery);
  
    if($runCheck)
    {
        $voteQuery = "Insert into poll_answers(user, poll, choice) values ('$user', '$poll', '$choice')";
        $runVote = mysqli_query($con, $voteQuery);
        
        //Get all users answers for this particular poll
        $answerQuery = "select * from poll_answers where poll = '$poll'";
        $runanswer = mysqli_query($con, $answerQuery);
        $countanswer = mysqli_num_rows($runanswer);

        //Get specific user's answer for this particular poll 
        $eachQuery = "select * from poll_answers where choice = '$choice' and poll = '$poll'";
        $runEach = mysqli_query($con, $eachQuery);
        $countEach = mysqli_num_rows($runEach);

        $percent = (($countEach / $countanswer) * 100);

        //check if option exists
        $checkper = "select id from poll_percent where choice = '$choice'";
        $runchecks = mysqli_query($con, $checkper); 
        $numrun = mysqli_num_rows($runchecks);

        if($numrun == 0)
        {
        $per = "insert into poll_percent (choice, percent) values ('$choice', '$percent')";
        $runPer = mysqli_query($con, $per);
        }

        elseif($numrun > 0)
        {
            $upPer = "UPDATE poll_percent set percent = '$percent' where choice = '$choice'";
            $runUp = mysqli_query($con, $upPer);
        }  

    } 
         
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
   <?php  
   echo "You have completed this poll, Below are the results";
   ?>

   <ul>
   <?php
   $selRes = "select * from poll_percent";
   $runRes = mysqli_query($con, $selRes);

   while($getRes = mysqli_fetch_array($runRes))
   {
      $get_name = $getRes['name'];
      $get_per = $getRes['percent'];
       echo "<li>$get_name</li>";
       echo "<li>$get_per</li>";
   }
   ?>
   </ul>
 
</body>
</html>


    


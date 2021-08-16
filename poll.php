<?php 
require_once 'app/init.php';

if(!isset($_GET['poll']))
{
  header('Location: index.php');
}

else
{
  $id = (int)$_GET['poll'];
  $user = $_SESSION['user_id'];

  //get general poll information
  $pollQuery = $db->prepare("SELECT id, question FROM polls WHERE id = :poll AND DATE(NOW()) BETWEEN starts AND ends");

  $pollQuery->execute([
    'poll' => $id
  ]);

  $poll = $pollQuery->fetchObject();


  //Has the user completed the poll?
  $comply = "select * from poll_answers where poll = '$id' and user = '$user'";
  $runcomply = mysqli_query($con, $comply);
  $completed = mysqli_num_rows($runcomply);

  if($completed == 1){
   echo 'You have finished this poll';  
 }

  else
  {
  //Get poll choices 
  $choicesQuery = $db->prepare("SELECT polls.id, polls_choices.id AS choice_id, polls_choices.name  
  FROM polls                 
  JOIN polls_choices                                    
  ON polls.id = polls_choices.poll
  WHERE polls.id = :poll
  AND DATE (NOW()) BETWEEN polls.starts 
  AND polls.ends");

  $choicesQuery->execute([
      'poll' => $id
  ]);

  //Extract choices
  while($row = $choicesQuery->fetchObject()){
    $choices[] = $row;
    }

  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <?php if(!$poll):?> <!--one line if statement-->
      <p>That poll does not exist</p>

  <?php else: ?> 
       <div class = "poll">
         <div class="poll-question">
            <?php echo $poll->question; ?>
         </div>   
          
           <?php if($completed): ?>  
              <ul> 
              <?php
                header('Location: vote.php');
              ?>
             </ul>

            <?php else: ?>
            <?php if(!empty($choices)): ?>
            <form action="vote.php" method="post">
              <div class="poll-options">

                <?php foreach($choices as $index => $choice): ?>
                <div class="poll-option"></div>
                    <input type = "radio" name ="choice" value = "<?php echo $choice->choice_id?>" id = "c<?php echo $index; ?>">
                    <label for="c<?php echo $index;?>"><?php echo $choice->name;?></label>
               
               <?php endforeach; ?>

              <input type="submit" value="Submit answer">
              <input type="hidden" name="poll" value = "<?php echo $id; ?>">   
              </form> 
            
              </div>
            
            </div>
           <?php else: ?>
           <p> There are no choices right now.</p>
           <?php endif;?>
          <?php endif; ?>

      </div>
<?php endif; ?> 
</body>
</html> 

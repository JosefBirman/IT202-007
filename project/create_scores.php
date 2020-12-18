<?php require_once(__DIR__ . "/lib/helpers.php"); ?>

<?php
    if(is_logged_in() && isset($_POST["score"])){
      $score = $_POST["score"];
      echo "Refresh the page to play again!";
      $db = getDB();
      $stmt = $db->prepare("INSERT INTO Scores (user_id, score) VALUES(:user_id, :score)");
      $stmt->execute([	
      ":user_id"=>get_user_id(),
		  ":score"=>$score
	    ]);
      
      $stmt = $db->prepare("INSERT INTO PointsHistory (user_id, points_change, reason) VALUES(:user_id, :change, :reason)");
      $stmt->execute([	
      ":user_id"=>get_user_id(),
		  ":change"=>$score/100,
      ":reason"=>"Earned from game."
	    ]);
      
      $sum = getBalance() + $_POST["score"]/100;
      $stmt = $db->prepare("UPDATE Users set points=:points where id= :id");
      $r = $stmt->execute([":points"=>$sum, ":id"=>get_user_id()]);
    }
    
?>

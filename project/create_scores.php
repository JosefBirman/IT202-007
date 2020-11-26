<?php require_once(__DIR__ . "/lib/helpers.php"); ?>

<?php
    if(is_logged_in() && isset($_POST["score"])){
      $user_id = get_user_id();
      $score = $_POST["score"];
      $db = getDB();
      $stmt = $db->prepare("INSERT INTO Scores (user_id, score) VALUES(:user_id, :score)");
      $stmt->execute([	
      ":user_id"=>$user_id,
		  ":score"=>$score
	    ]);
    }
?>

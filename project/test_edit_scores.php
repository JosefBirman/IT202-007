<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>
<?php
//we'll put this at the top so both php block have access to it
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
?>
<?php
//saving
if(isset($_POST["save"])){
	//TODO add proper validation/checks
  $id = $_POST["id"];
	$user_id = get_user_id();
	$score = $_POST["score"];
	$created = date('Y-m-d H:i:s');//calc
	$db = getDB();
	if(isset($id)){
		$stmt = $db->prepare("UPDATE Scores set id=:id, user_id=:user_id, score=:score, created=:created where id=:id");
		//$stmt = $db->prepare("INSERT INTO F20_Eggs (name, state, base_rate, mod_min, mod_max, next_stage_time, user_id) VALUES(:name, :state, :br, :min,:max,:nst,:user)");
		$r = $stmt->execute([
		  ":id"=>$id,
		  ":user_id"=>$user_id,
		  ":score"=>$score,
		  ":created"=>$created
		]);
		if($r){
			flash("Updated successfully with id: " . $id);
		}
		else{
			$e = $stmt->errorInfo();
			flash("Error updating: " . var_export($e, true));
		}
	}
	else{
		flash("ID isn't set, we need an ID in order to update");
	}
}
?>
<?php
//fetching
$result = [];
if(isset($id)){
	$id = $_POST["id"];
	$db = getDB();
	$stmt = $db->prepare("SELECT * FROM Scores where id = :id");
	$r = $stmt->execute([":id"=>$id]);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<form method="POST">
  <label>id</label>
	<input id="id" placeholder="id" name="id"/>
	<label>User_id</label>
	<input user_id="user_id" placeholder="user_id" name="user_id"/>
	<label>Score</label>
	<input score="score" placeholder="Score" name="score"/>
	<input type="submit" name="save" value="Update"/>
</form>


<?php require(__DIR__ . "/partials/flash.php");
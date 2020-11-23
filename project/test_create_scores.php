
<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>

<form method="POST">
  <label>id</label>
	<input id="id" placeholder="id" name="id"/>
	<label>User_id</label>
	<input user_id="user_id" placeholder="user_id" name="user_id"/>
	<label>Score</label>
	<input score="score" placeholder="score" name="score"/>
	<input type="submit" name="save" value="Create"/>
</form>

<?php
if(isset($_POST["save"])){
	//TODO add proper validation/checks
  $id = $_POST["id"];
	$user_id = get_user_id();
	$score = $_POST["score"];
	$created = date('Y-m-d H:i:s');//calc
	$db = getDB();
	$stmt = $db->prepare("INSERT INTO Scores (id, user_id, score, created) VALUES(:id, :user_id, :score, :created)");
	$r = $stmt->execute([
		":id"=>$id,
		":user_id"=>$user_id,
		":score"=>$score,
		":created"=>$created
	]);
	if($r){
		flash("Created successfully with id: " . $db->lastInsertId());
	}
	else{
		$e = $stmt->errorInfo();
		flash("Error creating: " . var_export($e, true));
	}
}
?>
<?php require(__DIR__ . "/partials/flash.php");

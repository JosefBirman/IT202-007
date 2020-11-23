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
	$points_change = $_POST["points_change"];
	$created = date('Y-m-d H:i:s');//calc
  $reason = $_POST["reason"];
	$db = getDB();
	if(isset($id)){
		$stmt = $db->prepare("UPDATE PointsHistory set id=:id, user_id=:user_id, points_change=:points_change, reason=:reason, created=:created where id=:id");
		$r = $stmt->execute([
		  ":id"=>$id,
		  ":user_id"=>$user_id,
		  ":points_change"=>$points_change,
      ":reason"=>$reason,
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
	$stmt = $db->prepare("SELECT * FROM PointsHistory where id = :id");
	$r = $stmt->execute([":id"=>$id]);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<form method="POST">
	<label>ID</label>
	<input score="id" placeholder="id" name="id"/>
	<label>User ID</label>
	<input user_id="user_id" placeholder="user_id" name="user_id"/>
  <label>Points Change</label>
  <input type="points_change" min="1" name="points_change"/>
  <label>Reason</label>
  <input type="reason" placeholder="reason for change" name="reason"/>
	<input type="submit" name="save" value="Update"/>
</form>


<?php require(__DIR__ . "/partials/flash.php");
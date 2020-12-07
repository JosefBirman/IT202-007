<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>
    <h3>Create Points History</h3>
    <form method="POST">
        <label>User ID</label>
        <input user_id="user_id" placeholder="User ID" name="user_id"/>
        <label>Points Change</label>
        <input type="points_change" min="1" name="points_change"/>
        <label>Reason</label>
        <input type="reason" placeholder="reason for change" name="reason"/>
        <input type="submit" name="save" value="Create"/>
    </form>

<?php
if (isset($_POST["save"])) {
    //TODO add proper validation/checks
    $user_id = get_user_id();
    $points_change = $_POST["points_change"];
    $created = date('Y-m-d H:i:s');
    $reason = $_POST["reason"];
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO PointsHistory (user_id, points_change, created, reason) VALUES(:user_id, :points_change, :created, :reason)");
    $r = $stmt->execute([
		":user_id"=>$user_id,
		":points_change"=>$points_change,
		":created"=>$created,
    ":reason"=>$reason
    ]);
    
    if ($r) {
        flash("Created successfully with id: " . $db->lastInsertId());
    }
    else {
        $e = $stmt->errorInfo();
        flash("Error creating: " . var_export($e, true));
    }
    
     //printing out points on profile
    $query = get_user_id();
    $points = 0;
    $result = [];
    $stmt = $db->prepare("SELECT points from Users WHERE id = $query");
    $r = $stmt->execute();
    if ($r) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($results as $r):
            $points = $r["points"];
            flash("Points Before Change: ". $points);
            endforeach;
    }
    $sum = $points + $points_change; //sum of points 
    $stmt = $db->prepare("UPDATE Users set points=:points where id=$query"); //updating points
    $r = $stmt->execute([":points"=>$sum]);
    flash("Points After Change: ". $sum);

}
?>

<?php require(__DIR__ . "/partials/flash.php");
<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>
<?php
$query = "";
$results = [];
if (isset($_POST["query"])) {
    $query = $_POST["query"];
}
if (isset($_POST["search"]) && !empty($query)) {
    $db = getDB();
    $stmt = $db->prepare("SELECT PointsHistory.id, PointsHistory.user_id, points_change, reason, PointsHistory.created FROM PointsHistory JOIN Scores on PointsHistory.user_id = Scores.user_id");
    $r = $stmt->execute();
    if ($r) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        flash("There was a problem fetching the results".var_export($stmt->errorInfo(), true));
    }
}
?>
<form method="POST">
    <input name="query" placeholder="Search" value="<?php safer_echo($query); ?>"/>
    <input type="submit" value="Search" name="search"/>
</form>
<div class="results">
    <?php if (count($results) > 0): ?>
        <div class="list-group">
            <?php foreach ($results as $r): ?>
                <div class="list-group-item">
                    <div>
                        <div>id:</div>
                        <div><?php safer_echo($r["id"]); ?></div> FIXIT: prints history of each one 3 times
                    </div>
                    <div>
                        <div>user id:</div>
                        <div><?php safer_echo($r["user_id"]); ?></div>
                    </div>
                    <div>
                        <div>points modified:</div>
                        <div><?php safer_echo($r["points_change"]); ?></div>
                    </div>
                    <div>
                        <div>reason:</div>
                        <div><?php safer_echo($r["reason"]); ?></div>
                    </div>
                    <div>
                        <div>created:</div>
                        <div><?php safer_echo($r["created"]); ?></div>
                    </div>
                    <div>
                        <a type="button" href="test_edit_pointshistory.php?id=<?php safer_echo($r['id']); ?>">Edit</a>
                        <a type="button" href="test_view_pointshistory.php?id=<?php safer_echo($r['id']); ?>">View</a>
                    </div>
                    <div>
                      <?php echo"<br>"; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No results</p>
    <?php endif; ?>
</div>
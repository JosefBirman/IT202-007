
<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
//we use this to safely get the email to display
$email = "";
if (isset($_SESSION["user"]) && isset($_SESSION["user"]["email"])) {
    $email = $_SESSION["user"]["email"];
}
?>
<<<<<<< HEAD
<p>Welcome, <?php echo $email; ?></p>
=======
<p>Welcome, <?php echo $email; ?></p>
>>>>>>> 1c4ec34f5100522fb3550c3f076eee60e2e835cd

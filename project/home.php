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
<?php require(__DIR__ . "/partials/flash.php");
=======
<p>Welcome, <?php echo $email; ?></p>
>>>>>>> 1b37c37bf64b8231dc8abe108c025698c76e73a6

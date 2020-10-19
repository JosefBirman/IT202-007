
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
<<<<<<< HEAD
<p>Welcome, <?php echo $email; ?></p>
>>>>>>> 7352cde47b312b9f3e6c359c78c488e019d6f173

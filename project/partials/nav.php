<link rel="stylesheet" href="static/css/styles.css">
<?php
require_once(__DIR__ . "/../lib/helpers.php");
?>
<nav>
<ul class="nav">
    <li><a href="home.php">HOME</a></li>
    <?php if (!is_logged_in()): ?></li>
        <li><a href="login.php">LOGIN</a></li>
        <li><a href="register.php">REGISTER</a></li>
    <?php endif; ?>
    <?php if (is_logged_in()): ?>
        <li><a href="profile.php">PROFILE</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
    <?php endif; ?>
</ul>
</nav>

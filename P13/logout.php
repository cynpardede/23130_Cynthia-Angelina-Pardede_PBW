<?php
session_start();
session_destroy();
header("Location: login.php?message=" . urlencode("Bye-byee."));
exit;
?>
<?php if (isset($_SESSION['login_PerpusUNSIKA'])): ?>
    <span class="navbar-text text-white ms-2">Halo, <?= htmlspecialchars($_SESSION['login_PerpusUNSIKA']); ?>!</span>
<?php endif; ?>

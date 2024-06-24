<?php require_once __DIR__ . '/header.php'; ?>

<?php
if (!empty($this->message)) {
    echo '<h3>' . $this->message . '</h3><br>';
    exit();
}
?>

<?php require_once __DIR__ . '/footer.php'; ?>
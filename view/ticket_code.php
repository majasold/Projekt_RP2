<?php require_once __DIR__ . '/header.php'; ?>

<main>
    <div id="qrcode"></div>
</main>

<script>
    let url = '<?php echo $this->generateURL($idReservation, $created, true); ?>'
    console.log(url)
    let qrcode = new QRCode("qrcode", url);
</script>

<?php require_once __DIR__ . '/footer.php'; ?>
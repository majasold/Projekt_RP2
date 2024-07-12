<?php require_once __DIR__ . '/header.php'; ?>

<main>
    <div class="qr-container">
        <div id="qrcode"></div>
    </div>
</main>

<script>
    let url = '<?php echo $this->generateURL($idReservation, $created, true); ?>'
    let logoSrc = 'https://upload.wikimedia.org/wikipedia/commons/9/91/Faculty_of_Science_PMF_Zagreb.jpg'
    console.log(url)
    let qrCode = new QRCode(document.createElement('div'), {
        text: url,
        width: 256,
        height: 256,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });

    // Get the QR code canvas
    let qrCanvas = qrCode._el.querySelector('canvas');
    let ctx = qrCanvas.getContext('2d');

    // Draw the logo on the QR code
    let logo = new Image();
    logo.src = logoSrc;
    logo.onload = function() {
        let logoSize = qrCanvas.width * 0.4; // Adjust the logo size as needed
        let x = (qrCanvas.width - logoSize) / 2;
        let y = (qrCanvas.height - logoSize) / 2;
        ctx.drawImage(logo, x, y, logoSize, logoSize);

        // Replace the original QR code element with the new one
        document.getElementById('qrcode').appendChild(qrCanvas);
        qrCanvas.style.display = "block";
    };
</script>

<?php require_once __DIR__ . '/footer.php'; ?>
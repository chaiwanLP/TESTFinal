<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <style> 
        .square_qr {
            background-color: rgb(255, 255, 255);
            height: 40px;
            margin-top: 50px;
            border-radius: 10px;
            width: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<?php 
    // สร้าง URL สำหรับ QR Code โดยเพิ่ม https://
    $qr_url = "https://" . htmlspecialchars($_SERVER['SERVER_NAME'] . "/check_in/" . $data['event']->qr_code_att, ENT_QUOTES, 'UTF-8');
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12 square_qr d-flex align-items-center justify-content-center">
            <p class="m-0">QR Code เช็คชื่อ</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div id="qrcode" data-url="<?php echo $qr_url; ?>"></div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6 d-flex align-items-center justify-content-center">
            <div>
                <p>กิจกรรม <?php echo htmlspecialchars($data['event']->title, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-center">
            <div>
                <p>รหัสเช็คชื่อ <?php echo htmlspecialchars($data['event']->text_code_att, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs2@0.0.2/qrcode.min.js"></script>
<script>
    window.onload = function() {
        let eventId = document.getElementById("qrcode").getAttribute("data-url"); // ดึงค่าจาก data-attribute

        new QRCode(document.getElementById("qrcode"), {
            text: eventId,
            width: 400,
            height: 400,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    };
</script>

</body>
</html>

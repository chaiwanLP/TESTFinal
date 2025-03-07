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
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 square_qr d-flex align-items-center justify-content-center">
                <p class="m-0">QR Code เช็คชื่อ</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div id="qrcode"></div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
            <div class="col-6 d-flex align-items-center justify-content-center">
                <div>
                    <p>กิจกรรมชื่อ.....</p>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center">
                <div>
                    <p>รหัสเช็คชื่อ.....</p>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/qrcodejs2@0.0.2/qrcode.min.js"></script>
    <script>
        window.onload = function() {
            new QRCode(document.getElementById("qrcode"), {
                text: "5555",
                width: 200,
                height: 200,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        };
    </script>
</body>
</html>

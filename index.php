<?php
/*
Plugin Name: QR Code Scanner Popup t-ma.ir
Description: A plugin [qr_code_scanner_popup] that creates a button to open a popup for scanning QR codes using the user's camera.+989981009827
Version: 1.0
Author: mohammad bagheri
*/

function qr_code_scanner_popup_shortcode() {
    ob_start();
    ?>
    <div class="qr-code-scanner-popup-container">
        <button id="scan-btn">Scanner qr code</button>
        <div id="qr-code-popup" class="qr-code-popup">
            <div class="qr-code-popup-content">
                <span class="close-btn">&times;</span>
                <h2>
Scanner qr code t-ma.ir                
</h2>
                <div id="my-qr-reader"></div>
            </div>
        </div>
    </div>
    <audio id="beep-sound" src="<?= plugin_dir_url( __FILE__ ); ?>/file/beep-28.mp3" preload="auto"></audio>
    <style>
        .qr-code-scanner-popup-container {
            text-align: center;
            margin-top: 20px;
        }
        #scan-btn {
            background-color: #029a49;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        #scan-btn:hover {
            background-color: #027b3c;
        }
        .qr-code-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .qr-code-popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
            color: #aaa;
        }
        .close-btn:hover {
            color: #000;
        }
        #my-qr-reader {
            padding: 20px !important;
            border: 1.5px solid #b2b2b2 !important;
            border-radius: 8px;
        }
        video {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        body {
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            box-sizing: border-box;
            text-align: center;
            background: rgb(128 0 0 / 66%);
        }
        .container {
            width: 100%;
            max-width: 500px;
            margin: 5px;
        }
        .container h1 {
            color: #ffffff;
        }
        .section {
            background-color: #ffffff;
            padding: 50px 30px;
            border: 1.5px solid #b2b2b2;
            border-radius: 0.25em;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
        }
        #my-qr-reader img[alt="Info icon"] {
            display: none;
        }
        #my-qr-reader img[alt="Camera based scan"] {
            width: 100px !important;
            height: 100px !important;
        }
        button {
            padding: 10px 20px;
            border: 1px solid #b2b2b2;
            outline: none;
            border-radius: 0.25em;
            color: white;
            font-size: 15px;
            cursor: pointer;
            margin-top: 15px;
            margin-bottom: 10px;
            background-color: #008000ad;
            transition: 0.3s background-color;
        }
        button:hover {
            background-color: #008000;
        }
        #html5-qrcode-anchor-scan-type-change {
            text-decoration: none !important;
            color: #1d9bf0;
        }
    </style>
    <script src="<?= plugin_dir_url( __FILE__ ); ?>/file/html5-qrcode.min.js
"></script>
<script>
    document.getElementById('scan-btn').addEventListener('click', function () {
        document.getElementById('qr-code-popup').style.display = 'flex';
        const html5QrCode = new Html5Qrcode("my-qr-reader");
        const beepSound = document.getElementById('beep-sound');
        html5QrCode.start(
            { facingMode: "environment" }, 
            { fps: 10, qrbox: 250 },
            qrCodeMessage => {
                beepSound.play();
                window.open(qrCodeMessage, '_blank');
            },
            errorMessage => {
                console.error(errorMessage);
            }
        ).catch(err => {
            console.error(err);
        });
    });

    document.querySelector('.close-btn').addEventListener('click', function () {
        document.getElementById('qr-code-popup').style.display = 'none';
        const video = document.getElementById('my-qr-reader');
        if (video && video.srcObject) {
            video.srcObject.getTracks().forEach(track => track.stop());
        }
    });
</script>

    <?php
    return ob_get_clean();
}

add_shortcode('qr_code_scanner_popup', 'qr_code_scanner_popup_shortcode');

<!DOCTYPE html>
<html>

<head>
    <title>Captura de Imagem</title>
</head>

<body>
    <h1>Captura de Imagem</h1>

    <video id="video" width="400" height="300" autoplay></video>
    <button id="capture-btn">Capturar</button>

    <script>
        // Acessa a câmera do dispositivo
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(function(stream) {
                var videoElement = document.getElementById('video');
                videoElement.srcObject = stream;
            })
            .catch(function(error) {
                console.error('Erro ao acessar a câmera: ', error);
            });

        // Captura a imagem
        var captureBtn = document.getElementById('capture-btn');
        captureBtn.addEventListener('click', function() {
            var videoElement = document.getElementById('video');

            var canvas = document.createElement('canvas');
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;

            var context = canvas.getContext('2d');
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            var image = canvas.toDataURL('image/png');

            // Envia a imagem para o servidor em PHP
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'upload.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Imagem enviada com sucesso!');
                }
            };
            xhr.send('image=' + encodeURIComponent(image));
        });
    </script>
</body>

</html>
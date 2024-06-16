<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkripsi Suara</title>
</head>
<body>
    <h1>Transkripsi Suara</h1>
    <br>
    <textarea id="result" rows="10" cols="90" placeholder="Hasil transkripsi suara akan muncul di sini..."></textarea> <br>
    <button id="start">Mulai</button>
    <button id="stop" disabled>Berhenti</button>

    <script>
        var startButton = document.getElementById('start');
        var stopButton = document.getElementById('stop');
        var resultElement = document.getElementById('result');

        var recognition = new webkitSpeechRecognition() || new SpeechRecognition();
        recognition.lang = 'id-ID'; // Bahasa Indonesia
        recognition.interimResults = true;

        startButton.addEventListener('click', function() {
            recognition.start();
            startButton.disabled = true;
            stopButton.disabled = false;
            resultElement.value = ''; // Membersihkan hasil sebelumnya
        });

        stopButton.addEventListener('click', function() {
            recognition.stop();
            startButton.disabled = false;
            stopButton.disabled = true;
        });

        recognition.addEventListener('result', function(event) {
            var lastResultIndex = event.results.length - 1;
            var result = event.results[lastResultIndex][0].transcript;
            resultElement.value = result;
        });

        recognition.addEventListener('error', function(event) {
            console.error('Terjadi kesalahan recognition: ', event.error);
        });

        recognition.addEventListener('end', function() {
            startButton.disabled = false;
            stopButton.disabled = true;
        });
    </script>
</body>
</html>

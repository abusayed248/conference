<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OnetimeOnetime.net Keypad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: black;
        }
        .keypad-container {
            max-width: 300px;
            margin: auto;
            text-align: center;
        }
        .keypad-button {
            width: 100px;
            height: 100px;
            font-size: 1.2rem;
            background-color: #dbe6f1;
            color: black;
            border: none;
        }
        .btn-danger {
            background-color: #dbe6f1;
            color: black;
        }
        .btn-secondary {
            background-color: #dbe6f1;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container text-center mt-5">
        <div class="keypad-container">
            <div class="row g-2">
                <div class="col-4"><button class="btn keypad-button">1<br><small>Rewind 15 sec</small></button></div>
                <div class="col-4"><button class="btn keypad-button">2<br><small>Pause/Play</small></button></div>
                <div class="col-4"><button class="btn keypad-button">3<br><small>Forward 15 sec</small></button></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-4"><button class="btn keypad-button">4<br><small>Rewind 1 min</small></button></div>
                <div class="col-4"><button class="btn keypad-button">5</button></div>
                <div class="col-4"><button class="btn keypad-button">6<br><small>Forward 1 min</small></button></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-4"><button class="btn keypad-button">7<br><small>Rewind 5 min</small></button></div>
                <div class="col-4"><button class="btn keypad-button">8</button></div>
                <div class="col-4"><button class="btn keypad-button">9<br><small>Forward 5 min</small></button></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-12"><button class="btn btn-danger keypad-button">0<br><small>Main Menu</small></button></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

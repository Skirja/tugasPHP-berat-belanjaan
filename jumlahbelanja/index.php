<?php

$buah = 0;
$sayur = 0;
$gula = 0;
$diskon = 0.15;
$total = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buah = $_POST["buah"];
    $sayur = $_POST["sayur"];
    $gula = $_POST["gula"];
    $total = ($buah + $sayur + $gula) * (1 - $diskon);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Harga</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Hitung Total Belanja
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="buah" class="form-label">Harga Buah:</label>
                                <input type="number" class="form-control" id="buah" name="buah" value="<?= isset($_POST['buah']) ? $_POST['buah'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="sayur" class="form-label">Harga Sayur:</label>
                                <input type="number" class="form-control" id="sayur" name="sayur" value="<?= isset($_POST['sayur']) ? $_POST['sayur'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="gula" class="form-label">Harga Gula:</label>
                                <input type="number" class="form-control" id="gula" name="gula" value="<?= isset($_POST['gula']) ? $_POST['gula'] : '' ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Hitung Total</button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                        </form>
                        <div id="hasil">
                            <?php
                            if (isset($_POST['buah']) && isset($_POST['sayur']) && isset($_POST['gula'])) {
                                echo "<div class='mt-3 fw-bold'>Total belanja Anda adalah: Rp." . $total . "</div>";

                                if ($total > 75000) {
                                    echo "<div class='mt-3 text-success fw-bold'>Selamat! Anda mendapatkan piring cantik.</div>";
                                } elseif ($total > 100000) {
                                    $diskon = $diskon + 0.1;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function resetForm() {
            document.getElementById('buah').value = '';
            document.getElementById('sayur').value = '';
            document.getElementById('gula').value = '';
            document.getElementById('hasil').innerHTML = '';
        }
    </script>
</body>

</html>
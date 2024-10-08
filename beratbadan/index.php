<?php

function beratBadan($tinggi, $gender)
{
    if ($gender == "pria") {
        $ideal = ($tinggi - 100) - (($tinggi - 100) * 0.1);
    } else if ($gender == "wanita") {
        $ideal = ($tinggi - 100) - (($tinggi - 100) * 0.15);
    } 
    
    return $ideal;
}

function processFormData($tinggi, $gender)
{
    if (empty($tinggi) || empty($gender)) {
        return "Tinggi badan dan jenis kelamin harus diisi.";
    }

    $idealWeight = beratBadan($tinggi, $gender);
    return $idealWeight;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berat Ideal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Hitung Berat Badan Ideal
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="tinggi" class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" class="form-control" id="tinggi" name="tinggi" value="<?= isset($_POST['tinggi']) ? $_POST['tinggi'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="bbaktual" class="form-label">Berat Aktual</label>
                                <input type="number" class="form-control" id="bbaktual" name="bbaktual" value="<?= isset($_POST['bbaktual']) ? $_POST['bbaktual'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="pria" value="pria" <?= isset($_POST['gender']) && $_POST['gender'] == 'pria' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="pria">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="wanita" value="wanita" <?= isset($_POST['gender']) && $_POST['gender'] == 'wanita' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="wanita">
                                        Wanita
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Hitung</button>
                            <button type="reset" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                        </form>

                        <div id="result-container" class="mt-3">
                            <?php
                            if (isset($_POST['tinggi']) && isset($_POST['gender']) && isset($_POST['bbaktual']) && !empty($_POST['tinggi']) && !empty($_POST['gender']) && !empty($_POST['bbaktual'])) {
                                $idealWeight = processFormData($_POST['tinggi'], $_POST['gender']);
                                echo "<div class='fw-bold'>Berat badan ideal Anda adalah: " . $idealWeight . " kg</div>";
                                if ($_POST['bbaktual'] < $idealWeight) {
                                    echo "<div class='mt-3 text-danger fw-bold'>BANYAKIN MAKAN!</div>";
                                } else if ($_POST['bbaktual'] > $idealWeight) {
                                    echo "<div class='mt-3 text-danger fw-bold'>LARI DONG!</div>";
                                } else if ($_POST['bbaktual'] == $idealWeight) {
                                    echo "<div class='mt-3 text-danger fw-bold'>IDEAL.</div>";
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
            document.getElementById('tinggi').value = '';
            document.getElementById('bbaktual').value = '';
            document.querySelectorAll('input[type="radio"]').forEach(el => el.checked = false); //Reset radio buttons
            document.getElementById('result-container').innerHTML = '';
        }
    </script>
</body>

</html>
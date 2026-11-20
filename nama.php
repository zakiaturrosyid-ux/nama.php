<?php
$nama = '';
$email = '';
$telepon = '';
$alamat = '';
$pesanError = [];
$berhasil = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telepon = trim($_POST['telepon'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    if ($nama === '') {
        $pesanError[] = 'Nama: Tidak boleh kosong';
    }
    if ($email === '') {
        $pesanError[] = 'Email: Tidak boleh kosong';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesanError[] = 'Format email salah';
    }
    if ($telepon === '') {
        $pesanError[] = 'Telepon: Tidak boleh kosong';
    } elseif (!ctype_digit($telepon)) {
        $pesanError[] = 'Nomor HP hanya boleh angka';
    }

    $berhasil = count($pesanError) === 0;
}

function aman($nilai)
{
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Pengguna</title>
</head>
<body>
    <h1>Form Data Pengguna</h1>

    <form action="" method="post">
        <p>
            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" name="nama" value="<?= aman($nama) ?>">
        </p>
        <p>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value="<?= aman($email) ?>">
        </p>
        <p>
            <label for="telepon">Telepon:</label><br>
            <input type="text" id="telepon" name="telepon" value="<?= aman($telepon) ?>">
        </p>
        <p>
            <label for="alamat">Alamat:</label><br>
            <textarea id="alamat" name="alamat" rows="4" cols="30"><?= aman($alamat) ?></textarea>
        </p>
        <button type="submit">Kirim</button>
    </form>

    <?php if ($pesanError): ?>
        <ul>
            <?php foreach ($pesanError as $pesan): ?>
                <li><?= aman($pesan) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($berhasil): ?>
        <h2>Data berhasil dikirim</h2>
        <p>Nama: <?= aman($nama) ?></p>
        <p>Email: <?= aman($email) ?></p>
        <p>Telepon: <?= aman($telepon) ?></p>
        <p>Alamat: <?= nl2br(aman($alamat)) ?></p>
    <?php endif; ?>
</body>
</html>

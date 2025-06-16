<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Admin | Tempahan Pelanggan</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<h1>Senarai Tempahan</h1>

<?php
$fail = "tempahan.txt";

if (file_exists($fail)) {
    $senarai = file($fail, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (count($senarai) > 0) {
        echo "<table>";
        echo "<tr><th>Tarikh</th><th>Nama</th><th>Telefon</th><th>Pesanan</th></tr>";

        foreach ($senarai as $baris) {
            // Contoh baris: [2025-06-15 18:22:01] Ahmad | 0123456789 | Chicken Popcorn x2
            preg_match('/\[(.?)\] (.?) \| (.?) \| (.?)$/', $baris, $padanan);

            if ($padanan) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($padanan[1]) . "</td>"; // tarikh
                echo "<td>" . htmlspecialchars($padanan[2]) . "</td>"; // nama
                echo "<td>" . htmlspecialchars($padanan[3]) . "</td>"; // telefon
                echo "<td>" . htmlspecialchars($padanan[4]) . "</td>"; // pesanan
                echo "</tr>";
            }
        }

        echo "</table>";
    } else {
        echo "<p>Tiada tempahan buat masa ini.</p>";
    }
} else {
    echo "<p>Fail tempahan belum wujud.</p>";
}
?>

</body>
</html>
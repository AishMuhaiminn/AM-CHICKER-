<?php
// Fail tempahan
$filename = 'tempahan.txt';

// Semak kalau fail wujud
if (!file_exists($filename)) {
    echo "<h2>Tiada tempahan dijumpai.</h2>";
    echo "<p>Fail tempahan.txt tidak wujud.</p>";
    exit;
}

// Baca semua baris tempahan
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (!$lines) {
    echo "<h2>Tiada tempahan dijumpai.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8" />
    <title>Admin - Senarai Tempahan</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        caption { font-size: 1.5em; margin-bottom: 10px; }
        .no-data { font-style: italic; color: #555; }
        a.back { display: inline-block; margin-top: 15px; text-decoration: none; color: #007BFF; }
        a.back:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h1>Admin - Senarai Tempahan</h1>

<table>
    <caption>Senarai Tempahan Dari tempahan.txt</caption>
    <thead>
        <tr>
            <th>Tarikh & Masa</th>
            <th>Nama</th>
            <th>Telefon</th>
            <th>Menu</th>
            <th>Kuantiti</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($lines as $line) {
            // Format asal contoh:
            // [2025-06-16 15:30:45] Nama | Telefon | Menu xKuantiti
            // Kita pecahkan ikut pattern ini
            if (preg_match('/\[(.*?)\]\s(.*?)\s\|\s(.*?)\s\|\s(.*?)\sx(\d+)/', $line, $matches)) {
                $tarikh = htmlspecialchars($matches[1]);
                $nama = htmlspecialchars($matches[2]);
                $telefon = htmlspecialchars($matches[3]);
                $menu = htmlspecialchars($matches[4]);
                $kuantiti = (int)$matches[5];

                echo "<tr>";
                echo "<td>$tarikh</td>";
                echo "<td>$nama</td>";
                echo "<td>$telefon</td>";
                echo "<td>$menu</td>";
                echo "<td>$kuantiti</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>

<p><a href="index.html" class="back">← Kembali ke Laman Utama</a></p>

</body>
</html>
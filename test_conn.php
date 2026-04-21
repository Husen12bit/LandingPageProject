<?php
// Test koneksi dengan berbagai format

$username = 'skillbantuin';
$password = '123';

// Format 1: Simple
$dsn1 = 'dbproject';
echo "Format 1 (simple): $dsn1\n";

// Format 2: TNS
$dsn2 = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=127.0.0.1)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=dbproject)))';
echo "Format 2 (TNS): $dsn2\n\n";

foreach ([$dsn1, $dsn2] as $i => $dsn) {
    echo "Mencoba format " . ($i+1) . "...\n";
    $conn = @oci_connect($username, $password, $dsn);

    if ($conn) {
        echo "✅ BERHASIL dengan format " . ($i+1) . "!\n";
        oci_close($conn);
        break;
    } else {
        $e = oci_error();
        echo "❌ GAGAL: " . $e['message'] . "\n\n";
    }
}

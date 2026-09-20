<?php
require_once __DIR__ . "/Film.php";
session_start();

if (!isset($_SESSION['daftarFilm'])) {
    $_SESSION['daftarFilm'] = [];
}

$pesan = "";

// menambahkan data film baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['aksi'] ?? '') === 'tambah') {
    $id = intval($_POST['id']);

    // mengecek apakah ID sudah ada
    $idSudahAda = false;
    foreach ($_SESSION['daftarFilm'] as $f) {
        if ($f->getId() === $id) { $idSudahAda = true; break; }
    }

    if ($idSudahAda) {
        $pesan = "Gagal: ID $id sudah digunakan film lain!";
    } else {
        $filmBaru = new Film(
            $id,
            trim($_POST['judul']),
            trim($_POST['genre']),
            trim($_POST['jamTayang']),
            trim($_POST['gambar'])
        );
        $_SESSION['daftarFilm'][] = $filmBaru;
        $pesan = "Data film berhasil ditambahkan!";
    }
}

// mengupdate data film
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['aksi'] ?? '') === 'update') {
    $id = intval($_POST['id']);
    foreach ($_SESSION['daftarFilm'] as $film) {
        if ($film->getId() === $id) {
            $film->setJudul(trim($_POST['judul']));
            $film->setGenre(trim($_POST['genre']));
            $film->setJamTayang(trim($_POST['jamTayang']));
            $film->setGambar(trim($_POST['gambar']));
            $pesan = "Data film berhasil diupdate!";
            break;
        }
    }
}

// menghapus data film
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    foreach ($_SESSION['daftarFilm'] as $index => $film) {
        if ($film->getId() === $id) {
            unset($_SESSION['daftarFilm'][$index]);
            $_SESSION['daftarFilm'] = array_values($_SESSION['daftarFilm']);
            $pesan = "Data film berhasil dihapus!";
            break;
        }
    }
}

// mencari data filmnya berdasarkan id atau judulnya
$hasilCari = null;
if (isset($_GET['cari']) && trim($_GET['cari']) !== '') {
    $keyword = strtolower(trim($_GET['cari']));
    $hasilCari = array_filter($_SESSION['daftarFilm'], function ($film) use ($keyword) {
        return strpos(strtolower($film->getJudul()), $keyword) !== false
            || strval($film->getId()) === $keyword;
    });
}

// mengecek apakah ada film yang ingin diedit
$filmEdit = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    foreach ($_SESSION['daftarFilm'] as $film) {
        if ($film->getId() === $id) {
            $filmEdit = $film;
            break;
        }
    }
}

$dataDitampilkan = $hasilCari !== null ? $hasilCari : $_SESSION['daftarFilm'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Data Bioskop</title>
<style>
    body { font-family: Arial, sans-serif; max-width: 900px; margin: 40px auto; background:#f9f9f9; color:#222; }
    h1 { text-align:center; }
    form { background:#fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 0 6px rgba(0,0,0,0.1); }
    label { display:block; margin-top:10px; font-weight:bold; }
    input[type=text], input[type=number] { width:100%; padding:8px; margin-top:4px; box-sizing:border-box; }
    button { margin-top:15px; padding:10px 18px; background:#ffcc00; border:none; border-radius:4px; cursor:pointer; font-weight:bold; }
    table { width:100%; border-collapse: collapse; background:#fff; }
    th, td { border:1px solid #ddd; padding:8px; text-align:left; vertical-align: top; }
    th { background:#222; color:#fff; }
    .pesan { padding:10px; background:#d4edda; border-radius:4px; margin-bottom:15px; }
    .aksi a { margin-right:8px; text-decoration:none; }
    img.thumb { max-width:60px; max-height:60px; display:block; margin-bottom:4px; }
    .search-box { display:flex; gap:10px; margin-bottom:20px; align-items:center; }
    .search-box input { flex:1; padding:8px; }
</style>
</head>
<body>

<h1>Manajemen Data Bioskop</h1>

<?php if ($pesan): ?>
    <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<h2><?= $filmEdit ? "Update Data Film" : "Tambah Data Film" ?></h2>
<form method="POST" action="index.php">
    <input type="hidden" name="aksi" value="<?= $filmEdit ? 'update' : 'tambah' ?>">

    <label>ID Film</label>
    <input type="number" name="id" value="<?= $filmEdit ? $filmEdit->getId() : '' ?>" <?= $filmEdit ? 'readonly' : 'required' ?>>

    <label>Judul Film</label>
    <input type="text" name="judul" value="<?= $filmEdit ? htmlspecialchars($filmEdit->getJudul()) : '' ?>" required>

    <label>Genre</label>
    <input type="text" name="genre" value="<?= $filmEdit ? htmlspecialchars($filmEdit->getGenre()) : '' ?>" required>

    <label>Jam Tayang</label>
    <input type="text" name="jamTayang" placeholder="contoh: 19:00" value="<?= $filmEdit ? htmlspecialchars($filmEdit->getJamTayang()) : '' ?>" required>

    <label>Path Gambar (lokal)</label>
    <input type="text" name="gambar" placeholder="contoh: gambar/poster1.jpg" value="<?= $filmEdit ? htmlspecialchars($filmEdit->getGambar()) : '' ?>" required>

    <button type="submit"><?= $filmEdit ? "Update Data" : "Tambah Data" ?></button>
    <?php if ($filmEdit): ?>
        <a href="index.php">Batal</a>
    <?php endif; ?>
</form>

<h2>Cari Data Film</h2>
<form method="GET" action="index.php" class="search-box">
    <input type="text" name="cari" placeholder="Cari berdasarkan ID atau Judul..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
    <button type="submit">Cari</button>
    <?php if (isset($_GET['cari'])): ?>
        <a href="index.php">Reset</a>
    <?php endif; ?>
</form>

<h2>Daftar Film</h2>
<?php if (empty($dataDitampilkan)): ?>
    <p>Belum ada data film.</p>
<?php else: ?>
<table>
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Genre</th>
        <th>Jam Tayang</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($dataDitampilkan as $film): ?>
    <tr>
        <td><?= $film->getId() ?></td>
        <td><?= htmlspecialchars($film->getJudul()) ?></td>
        <td><?= htmlspecialchars($film->getGenre()) ?></td>
        <td><?= htmlspecialchars($film->getJamTayang()) ?></td>
        <td>
            <?php if ($film->getGambar()): ?>
                <img class="thumb" src="<?= htmlspecialchars($film->getGambar()) ?>" alt="poster" onerror="this.style.display='none'">
            <?php endif; ?>
            <small><?= htmlspecialchars($film->getGambar()) ?></small>
        </td>
        <td class="aksi">
            <a href="?edit=<?= $film->getId() ?>">Edit</a>
            <a href="?hapus=<?= $film->getId() ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

</body>
</html>

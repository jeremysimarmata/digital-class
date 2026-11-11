<?php
declare(strict_types=1);
require dirname(__DIR__) . '/vendor/autoload.php';

use Kampus\CourseCatalog;
use Kampus\KrsService;

$catalog = new CourseCatalog();
$message = '';
$error = '';
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codes = $_POST['courses'] ?? [];
    if (!is_array($codes)) $codes = [];
    try {
        $result = (new KrsService($catalog))->register($codes);
        $message = 'Pengajuan KRS berhasil divalidasi (simulasi).';
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}
$courses = $catalog->all();
?>
<!doctype html>
<html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Digital Kampus — Simulasi KRS</title>
<style>
body{font-family:Arial,sans-serif;background:#f3f6fb;color:#17243a;margin:0}
main{max-width:820px;margin:40px auto;padding:28px;background:white;border-radius:14px}
h1{color:#164b83}.hint{color:#53657a}.course{display:flex;gap:12px;padding:13px;border:1px solid #dce5ef;border-radius:9px;margin:9px 0}
button{background:#1769aa;color:white;border:0;border-radius:8px;padding:12px 18px;cursor:pointer}
.success,.error{padding:12px;border-radius:8px;margin:15px 0}.success{background:#e5f7ec}.error{background:#fff0ef}
</style></head><body><main>
<h1>Digital Kampus</h1><p class="hint">Simulasi pengisian Kartu Rencana Studi (KRS)</p>
<?php if ($message): ?><p class="success"><?= htmlspecialchars($message) ?></p><?php endif; ?>
<?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="post"><h2>Pilih Mata Kuliah</h2>
<?php foreach ($courses as $code => $course): ?>
<label class="course"><input type="checkbox" name="courses[]" value="<?= htmlspecialchars($code) ?>">
<span><strong><?= htmlspecialchars($course['name']) ?></strong><br><small><?= htmlspecialchars($code) ?> · <?= (int)$course['credits'] ?> SKS</small></span></label>
<?php endforeach; ?>
<p class="hint">Batas pengambilan pada simulasi ini adalah 24 SKS.</p>
<button type="submit">Validasi Pengajuan KRS</button></form>
<?php if ($result): ?><h2>Ringkasan Pengajuan</h2><ul>
<?php foreach ($result['courses'] as $course): ?><li><?= htmlspecialchars($course['code'].' — '.$course['name']) ?> (<?= (int)$course['credits'] ?> SKS)</li><?php endforeach; ?>
</ul><strong>Total: <?= (int)$result['totalCredits'] ?> SKS</strong><?php endif; ?>
<p class="hint"><small>Prototipe pembelajaran; belum menyimpan data dan bukan layanan akademik produksi.</small></p>
</main></body></html>

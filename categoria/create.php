<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = db()->prepare('INSERT INTO categoria (NOMBRE_CAT, CODIGO) VALUES (?, ?)');
        $stmt->execute([trim($_POST['NOMBRE_CAT']), (int)$_POST['CODIGO']]);
        flash('success', 'Categoría creada.');
        redirect('index.php');
    } catch (PDOException $e) {
        $error = 'No fue posible crear la categoría. Verifique que el nombre no esté repetido.';
    }
}
$title = 'Nueva categoría';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>
<h1 class="mb-6 text-3xl font-bold">Nueva categoría</h1>
<?php if (!empty($error)): ?><div class="mb-4 rounded bg-red-50 p-3 text-red-700"><?= e($error) ?></div><?php endif; ?>
<form method="post" class="max-w-xl space-y-4 rounded-xl theme-surface p-6 shadow">
<label class="block">Nombre<input required maxlength="50" name="NOMBRE_CAT" class="form-input mt-1 w-full rounded-lg p-2"></label>
<label class="block">Código<input required type="number" name="CODIGO" class="form-input mt-1 w-full rounded-lg p-2"></label>
<button class="rounded bg-blue-600 px-4 py-2 text-white">Guardar</button>
<a href="index.php" class="ml-2 rounded bg-slate-300 px-4 py-2">Cancelar</a>
</form>
<?php require __DIR__ . '/../partials/footer.php'; ?>

<?php if ($flash = get_flash()): ?>
<div class="mb-4 rounded border p-4 <?= $flash['type'] === 'success' ? 'border-green-300 bg-green-50 text-green-800' : 'border-red-300 bg-red-50 text-red-800' ?>">
    <?= e($flash['message']) ?>
</div>
<?php endif; ?>

<div class="card card-body border-0 shadow-sm mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Страницы сайта</h2>
        <a href="index.php?action=add_post" class="btn btn-primary btn-sm">+ Создать страницу</a>
    </div>

    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Статус</th>
                <th>Дата создания</th>
                <th class="text-end">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $post['id'] ?></td>
                    <td><strong><?= htmlspecialchars($post['title']) ?></strong></td>
                    <td>
                        <span class="badge <?= $post['status'] === 'published' ? 'bg-success' : 'bg-warning text-dark' ?>">
                            <?= $post['status'] ?>
                        </span>
                    </td>
                    <td><?= date('d.m.Y H:i', strtotime($post['created_at'])) ?></td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="index.php?action=publish&id=<?= $post['id'] ?>" 
   class="btn btn-sm <?= $post['status'] === 'draft' ? 'btn-success' : 'btn-outline-secondary disabled' ?>">
   <?= $post['status'] === 'draft' ? 'Опубликовать' : 'Опубликовано' ?>
</a>
                            <a href="index.php?action=edit_post&id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-secondary">Ред.</a>
                            <a href="index.php?action=delete_post&id=<?= $post['id'] ?>" 
                                class="btn btn-sm btn-outline-danger" 
                                onclick="return confirm('Вы уверены, что хотите удалить эту страницу?')">
                                Удалить
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Страниц пока нет. Создайте первую!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
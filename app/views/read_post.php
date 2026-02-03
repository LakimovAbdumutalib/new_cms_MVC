<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-4">
                <a href="index.php?action=posts" class="btn btn-outline-secondary btn-sm">
                    &larr; Назад к списку
                </a>
            </div>

            <article class="blog-post">
                <h1 class="display-4 mb-3"><?= htmlspecialchars($post['title']) ?></h1>

                <p class="text-muted border-bottom pb-3">
                    <i class="bi bi-person"></i> Автор: <strong><?= htmlspecialchars($post['author_name'] ?? 'Неизвестен') ?></strong> | 
                    <i class="bi bi-calendar"></i> Опубликовано: <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>
                </p>

                <div class="post-content mt-4" style="line-height: 1.8; font-size: 1.1rem;">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </div>
            </article>

            <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $post['user_id'] || ($_SESSION['role'] ?? '') === '1')): ?>
                <div class="mt-5 pt-4 border-top">
                    <a href="index.php?action=edit_post&id=<?= $post['id'] ?>" class="btn btn-warning">Редактировать</a>
                    <a href="index.php?action=delete_post&id=<?= $post['id'] ?>" 
                       class="btn btn-danger" 
                       onclick="return confirm('Вы уверены, что хотите удалить этот пост?')">Удалить</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
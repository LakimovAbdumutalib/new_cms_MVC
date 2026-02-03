<?php
// home.php
// Ожидает: $posts (array), $page (int), $totalPages (int)
?>

<div class="container mt-4">

    <!-- Hero-блок -->
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Добро пожаловать!</h1>
            <p class="col-md-8 fs-5 text-muted mb-0">
                Здесь — свежие опубликованные посты. Выбирай и читай 🙂
            </p>
        </div>
    </div>

    <!-- Список постов -->
    <?php if (empty($posts)): ?>
        <div class="alert alert-secondary text-center" role="alert">
            Пока нет опубликованных постов.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">
                                <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
                            </h3>
                            <p class="card-text text-muted">
                                <?php
                                    $content = htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8');
                                    echo mb_strimwidth($content, 0, 150, "...");
                                ?>
                            </p>
                        </div>

                        <div class="card-footer bg-transparent border-0 pb-3">
                            <small class="text-muted">
                                Опубликовано:
                                <?= date('d.m.Y', strtotime($post['created_at'])) ?>
                            </small>
                            <br>
                            <a href="index.php?action=readPost&id=<?= (int)$post['id'] ?>"
                               class="btn btn-outline-primary btn-sm mt-2">
                                Читать далее
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Пагинация -->
        <?php if (!empty($totalPages) && $totalPages > 1): ?>
            <nav aria-label="pagination" class="mt-4">
                <ul class="pagination justify-content-center">

                    <!-- Назад -->
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="index.php?action=home&page=<?= $page - 1 ?>"
                           tabindex="<?= ($page <= 1) ? '-1' : '0' ?>">
                            Назад
                        </a>
                    </li>

                    <?php
                        $start = max(1, $page - 2);
                        $end   = min($totalPages, $page + 2);
                    ?>

                    <!-- Первая + многоточие слева -->
                    <?php if ($start > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?action=home&page=1">1</a>
                        </li>
                        <?php if ($start > 2): ?>
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Центральные страницы -->
                    <?php for ($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?action=home&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- Многоточие справа + последняя -->
                    <?php if ($end < $totalPages): ?>
                        <?php if ($end < $totalPages - 1): ?>
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        <?php endif; ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?action=home&page=<?= $totalPages ?>">
                                <?= $totalPages ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Вперёд -->
                    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="index.php?action=home&page=<?= $page + 1 ?>"
                           tabindex="<?= ($page >= $totalPages) ? '-1' : '0' ?>">
                            Вперёд
                        </a>
                    </li>

                </ul>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

</div>

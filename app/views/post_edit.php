<div class="card card-body border-0 shadow-sm mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Редактирование страницы</h2>
        <a href="index.php?action=posts" class="btn btn-outline-secondary btn-sm">Отмена</a>
    </div>

    <form action="index.php?action=edit_post&id=<?= $post['id'] ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" 
                   value="<?= htmlspecialchars($post['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Контент</label>
            <textarea name="content" id="content" class="form-control" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary px-5">Сохранить изменения</button>
        </div>
    </form>
</div>
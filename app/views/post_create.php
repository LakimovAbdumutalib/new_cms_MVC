<div class="card card-body border-0 shadow-sm mt-4">
    <h2>Создать новую страницу</h2>
    <form action="index.php?action=add_post" method="POST">
        <div class="mb-3">
            <label class="form-label">Заголовок</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Контент</label>
            <textarea name="content" class="form-control" rows="10" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="index.php?action=posts" class="btn btn-light">Отмена</a>
    </form>
</div>
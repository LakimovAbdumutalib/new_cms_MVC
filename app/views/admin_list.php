<div class="card card-body border-0 shadow-sm mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Список пользователей</h2>
    </div>

    <table class="table table-hover table-striped border">   
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th class="text-end">Действия</th> </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="3" class="text-center text-muted">Пользователей нет.</td>
                </tr>
            <?php endif; ?>
            <?php foreach ($users as $user): ?>
                <tr class="align-middle"> <td><span class="badge bg-secondary">#<?= $user['id']?></span></td>
                    <td><strong><?= htmlspecialchars($user['username']) ?></strong></td>
                    <td class="text-end">
                        <form action="index.php?action=delete_user" method="POST" class="d-inline" onsubmit="return confirm('Точно удалить?')">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
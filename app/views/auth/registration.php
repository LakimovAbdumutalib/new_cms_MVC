<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Регистрация</h3>
                <form action="index.php?action=registration" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                   
                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Создать аккаунт</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="index.php?action=login">Уже есть аккаунт? Войти</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS на MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body { background-color: #f8f9fa; }
        .table-container { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1 0 auto; 
        }

        footer {
            flex-shrink: 0;
        }


    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">Моя CMS</a>
    
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=home">Главная</a>
        </li>

        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=posts">Статьи</a>
          </li>
          <?php if ($_SESSION['role'] == '1'): ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=users">Пользователи</a>
          </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>

      <div class="d-flex">
    <div class="d-flex align-items-center">
    <?php if (isset($_SESSION['username'])): ?>
        <span class="navbar-text me-3 text-light">
            Привет, <span class="text-info fw-bold"><?= htmlspecialchars($_SESSION['username']) ?></span>
        </span>
        <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm shadow-sm">Выйти</a>
    <?php else: ?>
        <a href="index.php?action=login" class="btn btn-primary btn-sm px-3 me-2 shadow-sm">
            Войти
        </a>
        <a href="index.php?action=registration" class="btn btn-outline-info btn-sm px-3 shadow-sm">
            Создать аккаунт
        </a>
    <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="container">
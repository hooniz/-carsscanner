<?
/**
 * @var $user User
 */

use App\Modules\System\Container\Container;
use App\Modules\System\User\User;

$user = Container::getInstance()->get(User::class);
?>
<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/assets/logo-navbar.png" alt=""/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/main/">Данные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/question/">Связь с менеджером</a>
                </li>
                <?if($user->isAuthorized()):?>
                    <li class="nav-item dropup">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Профиль</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile/">Личный кабинет</a></li>
                            <li><a class="dropdown-item" href="/edit/">Ввести показания вручную</a></li>
                            <li><a class="dropdown-item text-danger" href="/logout/">Выйти</a></li>
                        </ul>
                    </li>
                <?endif;?>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
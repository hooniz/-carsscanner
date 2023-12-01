<?
$this->setTitle('Задать вопрос менеджеру');
$this->setPlaceholder('CSS', 'question');
?>
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">
    <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6">
        <form action="/question" method="post">
            <div class="form-header">
                <h4>Задать вопрос менеджеру</h4>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Как к Вам можно обращаться</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email для связи</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Вопрос</label>
                <textarea class="form-control" id="question" rows="3" name="question"></textarea>
            </div>
            <div class="form-footer">
                <div class="form-buttons">
                    <input type="submit" class="btn btn-primary" id="popup-open" value="Отправить вопрос">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="popup-fade">
    <div class="popup">
        <a class="popup-close" href="#">Закрыть</a>
        <h4>Спасибо за Ваше обращение!</h4>
        <p>
            Наш менеджер постарается ответить на Ваш вопрос в ближайшее время.
        </p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function($) {
        // Клик по ссылке "Закрыть".
        $('.popup-close').click(function() {
            $(this).parents('.popup-fade').fadeOut();
            return false;
        });

        <?if($result['result']):?>
            $('.popup-fade').fadeIn();
        <?endif;?>

        // Закрытие по клавише Esc.
        $(document).keydown(function(e) {
            if (e.keyCode === 27) {
                e.stopPropagation();
                $('.popup-fade').fadeOut();
            }
        });

        // Клик по фону, но не по окну.
        $('.popup-fade').click(function(e) {
            if ($(e.target).closest('.popup').length == 0) {
                $(this).fadeOut();
            }
        });
    });
</script>
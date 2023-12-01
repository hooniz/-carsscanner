<?
$this->setTitle('Регистрация в системе CarScanner');
$this->setPlaceholder('CSS', 'signup');
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0 main">
	<div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6">
		<form action="/signup/" method="POST">
			<div class="form-header">
				<h4>Регистрация в системе</h4>
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Email адрес</label>
				<input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?= $result['values']['email'] ?? '' ?>">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="email-check-agreement" name="mailing_agreement">
					<label class="form-check-label" for="email-check-agreement">
						Я согласен получать рекламную рассылку
					</label>
				</div>
			</div>
			<div class="mb-3">
				<label for="sensorId" class="form-label">Введите идентификатор вашего датчика</label>
				<input type="text" class="form-control" id="sensorId" placeholder="000XXX00" name="sensor" value="<?= $result['values']['sensor'] ?? '' ?>">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Придумайте сложный пароль</label>
				<input type="password" class="form-control" id="password" name="password">
			</div>
			<div class="mb-3">
				<label for="passwordRepeat" class="form-label">Повторите пароль</label>
				<input type="password" class="form-control" id="passwordRepeat" name="repeated_password">
			</div>
            <h5>Данные об автомобиле</h5>
            <div class="mb-3">
                <label for="carName" class="form-label">Название автомобиля</label>
                <select class="selectpicker form-select" id="carName" data-live-search="true" name="car">
                    <?foreach ($result['cars'] as $countries => $models):?>
                    <optgroup label="<?=$countries?>">
		                <?foreach ($models as $model):?>
                            <option value="<?=$model['id']?>"><?=$model['name']?></option>
		                <?endforeach;?>
		            <?endforeach;?>
                </select>
            </div>
            <div class="mb-3">
                <label for="datepicker" class="form-label">Год выпуска</label>
                <input type="text" class="form-control" name="year" id="datepicker" value="<?= $result['values']['year'] ?? '' ?>"/>
            </div>
            <div class="mb-3">
                <label for="engineType" class="form-label">Тип двигателя</label>
                <select class="selectpicker form-select" id="engineType" data-live-search="true" name="engine_type">
                    <option value="1" selected>Бензиновый</option>
                    <option value="2">Дизельный</option>
                </select>
            </div>
            <div class="mb-3" id="fuelTypeDiv">
                <label for="fuelType" class="form-label">Октановое число топлива</label>
                <input type="number" class="form-control" id="fuelType" name="fuel_type">
            </div>
			<div class="form-footer">
                <?if(isset($result['errors'])):?>
                    <?foreach ($result['errors'] as $error):?>
                        <div class="alert alert-danger" role="alert">
                            <?=$error?>
                        </div>
                    <?endforeach;?>
                <?endif;?>
				<p>Уже зарегистрированы? <a href="/signin/">Авторизоваться.</a> </p>
				<div class="form-buttons">
					<input type="submit" class="btn btn-primary" value="Зарегистрироваться">
					<button type="button" class="btn btn-danger">Очистить форму</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script>
    $("#datepicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autocomplete: true
    });

    $('#engineType').on('change', function (event) {
        if(this.value == 2)
        {
            $('#fuelTypeDiv').toggleClass('d-none');
        }else
        {
            $('#fuelTypeDiv').toggleClass('d-none');
        }
    });
</script>
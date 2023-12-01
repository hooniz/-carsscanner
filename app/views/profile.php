<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<?
$this->setTitle("Личный кабинет");
$this->setPlaceholder('CSS', 'profile');
?>
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">
    <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6">
    <form action="/profile/" method="post">
        <div class="form-header">
            <h4>Личный кабинет</h4>
            <p>
                Тут вы можете сменить некоторые данные
            </p>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email адрес</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?=$result['user']['email']??''?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Новый пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="passwordRepeat" class="form-label">Повторите пароль</label>
            <input type="password" class="form-control" id="repeated_password" name="repeated_password">
        </div>
        <div class="mb-3">
            <label for="sensorId" class="form-label">Идентификатор датчика</label>
            <input type="text" class="form-control" id="sensorId" placeholder="000XXX00" name="sensor" value="<?=$result['user']['code']??''?>" readonly>
        </div>
        <h5>Данные об автомобиле</h5>
        <div class="mb-3">
            <label for="carName" class="form-label">Название автомобиля</label>
            <select class="selectpicker form-select" id="carName" data-live-search="true" name="car">
                <?foreach ($result['cars'] as $countries => $models):?>
                <optgroup label="<?=$countries?>">
                    <?foreach ($models as $model):?>
                        <option value="<?=$model['id']?>" <?=$model['id']==$result['user']['model']?'selected':''?>><?=$model['name']?></option>
                    <?endforeach;?>
                <?endforeach;?>
            </select>
        </div>
        <div class="mb-3">
            <label for="datepicker" class="form-label">Год выпуска</label>
            <input type="text" class="form-control" name="datepicker" id="datepicker" value="<?=$result['user']['manufacturedYear']??''?>"/>
        </div>
        <?if($result['user']['engineType'] == 1):?>
            <div class="mb-3" id="fuelTypeDiv">
                <label for="fuelType" class="form-label">Октановое число топлива</label>
                <input type="number" class="form-control" id="fuelType" name="fuel_type" value="<?=$result['user']['fuelType']?>">
            </div>
        <?endif;?>
        <div class="form-footer">
            <?if(isset($result['errors'])):?>
                <?foreach ($result['errors'] as $errors):?>
                    <div class="alert alert-danger" role="alert">
                        <?foreach ($errors as $error):?>
                        <?=$error?>
                        <?endforeach;?>
                    </div>
                <?endforeach;?>
            <?endif;?>
            <div class="form-buttons">
                <input type="submit" class="btn btn-primary" value="Сохранить данные">
            </div>
        </div>
    </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script>
    $("#datepicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autocomplete: true
    });
</script>
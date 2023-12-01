<?
$this->setTitle('Авторизация в системе CarScanner');
$this->setPlaceholder('CSS', 'signin');
?>
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">
	<div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6">
		<form action="/signin/" method="POST">
			<div class="form-header">
				<h4>Авторизация в системе</h4>
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Email адрес</label>
				<input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?=$result['email']??''?>">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Пароль</label>
				<input type="password" class="form-control" id="password" name="password">
			</div>
			<div class="form-footer">
					<?if(isset($result['errors'])):?>
						<?foreach ($result['errors'] as $error):?>
							<div class="alert alert-danger" role="alert">
								<?=$error?>
							</div>
						<?endforeach;?>
					<?endif;?>
				<p>Еще не зарегистрированы? <a href="/signup/">Зарегистрироваться.</a> </p>
				<div class="form-buttons">
					<input type="submit" class="btn btn-primary" value="Войти">
				</div>
			</div>
		</form>
	</div>
</div>
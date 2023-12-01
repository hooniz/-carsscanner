<?
$this->setTitle("Мой автомобиль");
$this->setPlaceholder('CSS', 'main');
foreach ($result['user']['cars'] as $car)
{
    if($car['id'] == $result['user']['user']['model'])
    {
	    $result['user']['user']['model'] = $car['name'];
    }
}
switch ($result['user']['user']['engineType'])
{
    case 1:
	    $result['user']['user']['engineType'] = "Бензиновый";

	case 2:
		$result['user']['user']['engineType'] = "Дизельный";
}
?>
<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">
    <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Мой автомобиль
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <li class="list-group-item">Модель автомобиля - <?=$result['user']['user']['model']?></li>
                            <li class="list-group-item">Год выпуска - <?=$result['user']['user']['manufacturedYear']?></li>
                            <li class="list-group-item">Тип двигателя - <?=$result['user']['user']['engineType']?></li>
                            <?if($result['user']['user']['fuelType'] == 1):?>
                                <li class="list-group-item">Тип топлива - <?=$result['user']['user']['fuelType']?></li>
                            <?endif;?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Показания системы
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
	                    <?if(isset($result['values']) && count($result['values'])):?>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Критерии оценки</th>
                                <th scope="col">Показатель</th>
                                <th scope="col">Результат</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?foreach ($result['values'] as $component):?>
                                <tr <?=$component['error']?'class="table-danger"':'scope="row"'?>>
                                    <th><?=$component['name']?></th>
                                    <td><?=$component['value']?></td>
                                    <td><?=$component['message']?></td>
                                </tr>
                            <?endforeach;?>
                            </tbody>
                        </table>
	                    <?else:?>
                            <h4>Показания датчика отсутствуют</h4>
	                    <?endif;?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Рекомендации
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
	                    <?if(isset($result['messages'])):?>
		                    <?if(!$result['messages']):?>
                                <h4>Проблем не обнаружено.</h4>
		                    <?else:?>
                                <h4>Найденные проблемы:</h4>
			                    <?foreach ($result['messages'] as $message):?>
                                    <p><?=$message?></p>
			                    <?endforeach;?>
		                    <?endif;?>
	                    <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
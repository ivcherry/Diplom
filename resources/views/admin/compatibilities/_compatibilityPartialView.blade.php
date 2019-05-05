<div class="model-data">
    <h3>Совместимость №{{$compatibilityModel->getId()}}</h3>
    <input type="hidden" id="compatibilityId" value="{{$compatibilityModel->getId()}}">
    <div>
        <div>
             <span>Для подкатегории <b>"{{$compatibilityModel->getFirstType()->getName()}}"</b>
                     с характеристикой <b>"{{$compatibilityModel->getFirstFeature()->getName()}}"</b>
             </span>
        </div>
        <div>
            <span>и подкатегории <b>"{{$compatibilityModel->getSecondType()->getName()}}"</b>
              с характеристикой <b>"{{$compatibilityModel->getSecondFeature()->getName()}}"</b>
            </span>
        </div>
        <div>
            <span>Установлена совместимость по правилу <b>"{{$compatibilityModel->getRule()}}"</b>
            </span>
        </div>
    </div>
</div>


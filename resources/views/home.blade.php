@extends('client.layouts.clientLayout')

@section('content')
    <div id="carousel-1z" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-1z" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-1z" data-slide-to="1"></li>
            <li data-target="#carousel-1z" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block w-100"
                     src="https://i.simpalsmedia.com/999.md/BoardImages/900x900/e391fa92a467ddbd39334268954daa3b.jpg"
                     style="max-height: 400px;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(129).jpg"
                     style="height: 400px;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg"
                     style="height: 400px;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-1z" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-1z" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container-fluid">
        <h3 class="main-header">Товары дня</h3>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="img-container">
                        <img class="card-img-top"
                             src="https://c.dns-shop.ru/thumb/st1/fit/800/650/932b8224c73202af73c3d2a1c8435f2e/79e0640277dd7c64cc52b6b9589c3bd37266067dc851c8e49ce088239b9bd52b.jpg">
                    </div>
                    <div class="card-body">
                        <div class="main-description">
                            <h5 class="card-title"><a>6.4" Смартфон Samsung Galaxy A20 32 ГБ красный</a></h5>
                            <p class="card-text">Samsung Galaxy A20 получил дизайн, который компания называет 3D
                                Glasstic. Это полированный пластик, имитирующий премиальное стеклянное покрытие.
                                Смартфон
                                оборудован Super AMOLED экраном. Панель характеризуется высокой контрастностью и
                                энергоэффективностью.</p>
                        </div>
                        <div class="buy-menu">
                            <a href="#" class="btn btn-primary btn-md">Купить</a> <span><h5>13 999 ₽</h5></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="img-container">
                        <img class="card-img-top"
                             src="https://c.dns-shop.ru/thumb/st4/fit/800/650/daad042f8115a4d2e0c81827974d120d/4f2463f5b9f729e72aa458cde9fca3ca636f44b40cb2c78b0a6d355f822e13c6.jpg">
                    </div>
                    <div class="card-body">
                        <div class="main-description">
                            <h5 class="card-title"><a>6.1" Смартфон Apple iPhone Xr 64 ГБ красный</a></h5>
                            <p class="card-text">Смартфон Apple iPhone Xr – это особенное устройство, которое выполнено
                                в
                                красном корпусе с диагональю экрана 6.1" и представляет собой мощную и функциональную
                                модель. Аппарат с 64 ГБ памяти поддерживает работу процессора A12 Bionic,
                                демонстрирующий невероятную вычислительную способность.</p>
                        </div>
                        <div class="buy-menu">
                            <a href="#" class="btn btn-primary btn-md">Купить</a> <span><h5>59 999 ₽</h5></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="img-container">
                        <img class="card-img-top"
                             src="https://c.dns-shop.ru/thumb/st1/fit/800/650/f90e2fda1f0b3bf27e909a9d17d727de/8b2e9a895bfa4a413d10ca730b1cdd30dfd62ff8a18330a8baa0d3ffb31bdbad.jpg">
                    </div>
                    <div class="card-body">
                        <div class="main-description">
                            <h5 class="card-title"><a>5.84" Смартфон Huawei P20 Lite 64 ГБ синий</a></h5>
                            <p class="card-text">Смартфон Huawei P20 Lite притягивает взгляды оригинальной
                                расцветкой металлического корпуса, переливающейся различными оттенками синего цвета.
                                Такое оригинальное
                                дизайнерское решение делает эту модель фаворитом у неординарных личностей, уставших от
                                цифровой техники с классическим окрасом оболочки.</p>
                        </div>
                        <div class="buy-menu">
                            <a href="#" class="btn btn-primary btn-md">Купить</a> <span><h5>14 999 ₽</h5></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="img-container">
                        <img class="card-img-top"
                             src="https://c.dns-shop.ru/thumb/st1/fit/800/650/e828b803dafdf1f390eb4b21090155d9/8d0f894aab61ecfe8d580b709e1a7f045b233297f0503de5b91b1b16856284f5.jpg">
                    </div>
                    <div class="card-body">
                        <div class="main-description">
                            <h5 class="card-title"><a>9.7" Планшет Apple iPad 2018 Wi-Fi 128 Гбайт серебристый</a></h5>
                            <p class="card-text">Давайте представим, что компьютер изобрели сегодня. Какой он?
                                Очень мощный, чтобы справляться с любыми задачами. Невероятно портативный, чтобы
                                носить его с собой повсюду. А ещё он настолько удобный, что им можно управлять, просто
                                прикасаясь к экрану. Или с помощью клавиатуры. И даже карандашом. Другими словами, это
                                не совсем
                                компьютер. Это iPad 2018.</p>
                        </div>
                        <div class="buy-menu">
                            <a href="#" class="btn btn-primary btn-md">Купить</a> <span><h5>31 999 ₽</h5></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="main-header">Товары недели</h3>
        <div class="row">
            <div class="col">
                <div class="card second">
                    <span class="hit">ХИТ продаж !</span>
                    <div class="img-container">
                        <img class="card-img-top"
                             src="https://cdn.fotosklad.ru/upload/iblock/9f9/9f965f5ad9ff2b1fd63842938144da30_thumb_4d76a05b13f4590.jpg"
                             style="width: 200%">
                    </div>
                    <div class="card-body">
                        <div class="main-description">
                            <h5 class="card-title"><a>Ноутбук Asus VivoBook X540NA-GQ149 черный</a></h5>
                            <p class="card-text">Samsung Galaxy A20 получил дизайн, который компания называет 3D
                                Ноутбуки ASUS серии VivoBook X отличаются великолепными мультимедийными возможностями.
                                Оснащенные мощным процессором и видеокартой, они справятся с самыми ресурсоемкими
                                задачами. Эксклюзивная аудиотехнология SonicMaster обеспечивает беспрецедентное качество
                                звучания.</p>
                        </div>
                        <div class="buy-menu">
                            <a href="#" class="btn btn-primary btn-md">Купить</a> <span><h5>14 790 ₽</h5></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card second">
                    <span class="hit">ХИТ продаж !</span>
                    <div class="img-container">
                        <img class="card-img-top"
                             src="https://c.dns-shop.ru/thumb/st1/fit/800/650/c67167f004378a4750175ce748a18fee/98d4685891ba8277cbe1d3f4b57e9cba2a93acde811a7352a3fefd27e5b521fb.jpg"
                             style="width: 200%">
                    </div>
                    <div class="card-body">
                        <div class="main-description">
                            <h5 class="card-title"><a>24" (61 см) Телевизор LED Erisson 24HLE20T2 черный</a></h5>
                            <p class="card-text">Телевизор LED Erisson 24HLE20T2 установлен на удобную подставку и
                                предусматривает возможность фиксации на стене. Модель выполнена в компактном корпусе
                                черного цвета с диагональю экрана 24" (61 см), что позволяет установить телевизор в
                                наиболее удобном для пользователя месте. Экран устройства демонстрирует качественное
                                изображение в разрешении 1366x768 (HD).</p>
                        </div>
                        <div class="buy-menu">
                            <a href="#" class="btn btn-primary btn-md">Купить</a> <span><h5>9 999 ₽</h5></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card second">
                    <span class="hit">ХИТ продаж !</span>
                    <div class="img-container">
                        <img class="card-img-top"
                             src="https://c.dns-shop.ru/thumb/st4/fit/800/650/5be4eb3cd76ab61c40d04cc1b44a14fc/60da2320b14a8dacfefae617ef5c25975f3eaff0593cdcc888a06cf029134caa.jpg"
                             style="width: 200%">
                    </div>
                    <div class="card-body">
                        <div class="main-description">
                            <h5 class="card-title"><a>13.3" Ноутбук Apple MacBook Pro Retina (MPXQ2RU/A) серый</a></h5>
                            <p class="card-text">Ноутбук Apple MacBook Pro Retina (MPXQ2RU/A) уже успел полюбиться
                                миллионам пользователей своим утонченным внешним видом и производительным техническим
                                оснащением. В основе данной модели лежит операционная система Mac OS Sierra, способная
                                раскрыть все возможности аппаратной части устройства. Особенностью рассматриваемой
                                техники является надежный корпус.</p>
                        </div>
                        <div class="buy-menu">
                            <a href="#" class="btn btn-primary btn-md">Купить</a> <span><h5>73 999 ₽</h5></span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col">


                <div class="card second">
                    <span class="hit">ХИТ продаж !</span>
                    <div class="img-container">
                        <img class="card-img-top"
                             src="https://c.dns-shop.ru/thumb/st1/fit/800/650/634456980695f5eee70651d23687e579/9a71088fa68aae1db7b377cb4d74a005c0371f6cdb1d6a5006643d966710e0b6.jpg">
                    </div>
                    <div class="card-body">
                        <div class="main-description">
                            <h5 class="card-title"><a>4" Смартфон Apple iPhone SE "Как Новый" 16 ГБ серый</a></h5>
                            <p class="card-text">Описание 4" Смартфон Apple iPhone SE "Как Новый" 16 ГБ серый
                                Смартфон Apple iPhone SE – оптимальный выбор тех, кто предпочитает мощные функциональные
                                аппараты, позволяющие создавать фото и записывать видео отличного качества. Смартфон
                                снабжен камерой на 12 Мп с уникальной оптикой и массой дополнительных функций.</p>
                        </div>
                        <div class="buy-menu">
                            <a href="#" class="btn btn-primary btn-md">Купить</a> <span><h5>16 999 ₽</h5></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

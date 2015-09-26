<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<div class="container-fluid">
    <div class="header row">
        <div class="logo col-md-4">
            <img src="/img/logo_text.png" alt="Netping Logo">
        </div>
        <div class="info col-md-8">
            <div class="row">
                <div class="col-md-3"><h1>DKST 69</h1></div>
                <div class="col-md-4 info">
                    <p>Имя: dkst.localhost</p>

                    <p>Адрес: Москва, ул. Пушкина, 17</p>
                </div>
                <div class="col-md-3">
                    <a href="#" class="notifications">Уведомления (3) <span class="fa fa-angle-down"></span></a>
                </div>
                <div class="col-md-2 text-right">
                    <p>admin</p>
                    <a>выход <span class="fa fa-sign-out"></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="page row">
        <div class="menu col-md-4">
            <ul>
            	@if($currentMenu == "main")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/">Главная страница</a></li>
                @if($currentMenu == "admin")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/admin">Администрирование</a></li>
                @if($currentMenu == "network")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/network">Сетевые параметры</a></li>
                @if($currentMenu == "notifications/config")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/notifications/config">Настройки уведомлений</a></li>
                @if($currentMenu == "firmware")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/firmware">Прошивка</a></li>
                @if($currentMenu == "log")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/log">Журнал</a></li>
                @if($currentMenu == "sockets")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/sockets">Розетки</a></li>
                @if($currentMenu == "sensors")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/sensors">Датчики</a></li>
                @if($currentMenu == "notifications")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/notifications">Уведомления</a></li>
                @if($currentMenu == "reports")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/reports">Отчёты</a></li>
                @if($currentMenu == "logic")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/logic">Логика</a>
                </li>
            </ul>
        </div>
        <div class="content col-md-8">
        @yield("content")

<!--             <p>

            <h2>Розетки</h2>
            <table class="sockets">
                <tr>
                    <th>#</th>
                    <th>Нагрузка</th>
                    <th>Состояние</th>
                    <th>Управляется</th>
                    <th>История</th>
                    <th>Скрыть</th>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td><a href="#">Чайник</a></td>
                    <td><span class="fa fa-circle condition condition-on"></span>вкл</td>
                    <td class="text-center">Вручную</td>
                    <td>Включено 11.10.2014, сторож</td>
                    <td class="text-center"><span class="fa fa-times hide-socket"></span></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td><a href="#">Сервер А</a></td>
                    <td><span class="fa fa-circle condition condition-off"></span>выкл</td>
                    <td class="text-center">Автоматически</td>
                    <td>Выключено 01.10.2014, автомат защиты</td>
                    <td class="text-center"><span class="fa fa-times hide-socket"></span></td>
                </tr>
            </table>
            </p>
            <p>
                <button class="btn btn-default show-sockets-btn">
                    Показать скрытые розетки
                </button>
            </p>
            <p>

            <h2>Датчики</h2>

            <table class="sensors">
                <tr>
                    <th>Датчик</th>
                    <th>Состояние</th>
                    <th>Скрыть</th>
                </tr>
                <tr>
                    <td class="vert">Датчик температуры</td>
                    <td>
                        <a href="#" class="sensor-status shutter"><span class="fa fa-check"></span>14:33: норма<span
                                class="fa fa-angle-up"></span></a>
                        <ul class="sensor-status-history">
                            <li><span class="fa fa-exclamation-triangle"></span> 13:37: всё очень плохо</li>
                        </ul>
                    </td>
                    <td class="text-center"><span class="fa fa-times hide-sensor"></span></td>
                </tr>
            </table>
            </p>
            <p>
                <button class="btn btn-default show-sensors-btn">
                    Показать скрытые датчики
                </button>
            </p>
            <h2>Устройство</h2>
            <table class="device">
                <tr>
                    <th>Модель устройства</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>Серийный номер</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>Версия ПО</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>Версия железа</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>Контактные данные</th>
                    <td>lorem</td>
                </tr>
            </table>
            <h2>Настройка сети</h2>
            <table class="network-settings">
                <tr>
                    <th>MAC-адрес</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>IP-адрес</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>Маска подсети</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>Шлюз</th>
                    <td>lorem</td>
                </tr>
            </table> -->



        </div>
    </div>

</div>

<div class="footer">
    <div class="col-xs-6">Copyright © ЗАО "Алентис Электроникс"</div>
    <div class="col-xs-6 text-right">Время непрерывной работы: 3 д 14 ч 33 м 15 с</div>
</div>

<!-- <div class="overlay">
    <div class="window">
        <div class="content">
            <table class="show-sensors" style="display: none;">
                <tr>
                    <th>Датчик</th>
                    <th>Показать</th>
                </tr>
                <tr>
                    <td>Датчик температуры</td>
                    <td class="text-center"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Датчик влажности</td>
                    <td class="text-center"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td>Токовый датчик</td>
                    <td class="text-center"><input type="checkbox"></td>
                </tr>
            </table>
            <table class="show-sockets">
                <tr>
                    <th>#</th>
                    <th>Нагрузка</th>
                    <th>Состояние</th>
                    <th>Управляется</th>
                    <th>Показать</th>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>Чайник</td>
                    <td><span class="fa fa-circle condition condition-on"></span>вкл</td>
                    <td class="text-center">Вручную</td>
                    <td class="text-center"><input type="checkbox"></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Сервер А</td>
                    <td><span class="fa fa-circle condition condition-off"></span>выкл</td>
                    <td class="text-center">Автоматически</td>
                    <td class="text-center"><input type="checkbox"></td>
                </tr>
            </table>
        </div>
        <div class="buttons">
            <button class="btn btn-success save">
                Показать
            </button>
            <button class="btn btn-default cancel">
                Отмена
            </button>
        </div>
    </div>
</div> -->


<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/overlay.js"></script>
</body>
</html>
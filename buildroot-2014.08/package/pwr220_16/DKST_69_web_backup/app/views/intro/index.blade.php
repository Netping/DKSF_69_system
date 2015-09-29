@section("content")
            <p>

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
            </table>
@stop
@section("content")
            <p>

            <h2>{{Lang::get("index.sockets")}}</h2>
            <table class="sockets">
                <tr>
                    <th>#</th>
                    <th>{{Lang::get("index.charge")}}</th>
                    <th>{{Lang::get("index.state")}}</th>
                    <th>{{Lang::get("index.controlled")}}</th>
                    <th>{{Lang::get("index.history")}}</th>
                    <th>{{Lang::get("index.hide")}}</th>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td><a href="#">Чайник</a></td>
                    <td><span class="fa fa-circle condition condition-on"></span>{{Lang::get("index.on")}}</td>
                    <td class="text-center">{{Lang::get("index.manual")}}</td>
                    <td>Включено 11.10.2014, сторож</td>
                    <td class="text-center"><span class="fa fa-times hide-socket"></span></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td><a href="#">Сервер А</a></td>
                    <td><span class="fa fa-circle condition condition-off"></span>{{Lang::get("index.off")}}</td>
                    <td class="text-center">{{Lang::get("index.automatic")}}</td>
                    <td>Выключено 01.10.2014, автомат защиты</td>
                    <td class="text-center"><span class="fa fa-times hide-socket"></span></td>
                </tr>
            </table>
            </p>
            <p>
                <button class="btn btn-default show-sockets-btn">
                    {{Lang::get("index.show_hidden_sockets")}}
                </button>
            </p>
            <p>

            <h2>{{Lang::get("index.sensors")}}</h2>

            <table class="sensors">
                <tr>
                    <th>{{Lang::get("index.sensor")}}</th>
                    <th>{{Lang::get("index.state")}}</th>
                    <th>{{Lang::get("index.hide")}}</th>
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
                    {{Lang::get("index.show_hidden_sensors")}}
                </button>
            </p>
            <h2>{{Lang::get("index.device")}}</h2>
            <table class="device">
                <tr>
                    <th>{{Lang::get("index.device_model")}}</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>{{Lang::get("index.serial_number")}}</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>{{Lang::get("index.software_version")}}</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>{{Lang::get("index.hard_version")}}</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>{{Lang::get("index.contacts")}}</th>
                    <td>lorem</td>
                </tr>
            </table>
            <h2>{{Lang::get("index.network_config")}}</h2>
            <table class="network-settings">
                <tr>
                    <th>{{Lang::get("index.mac_address")}}</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>{{Lang::get("index.ip_address")}}</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>{{Lang::get("index.network_subnet")}}</th>
                    <td>lorem</td>
                </tr>
                <tr>
                    <th>{{Lang::get("index.gate")}}</th>
                    <td>lorem</td>
                </tr>
            </table>
@stop
@section("content")
                <form class="form-horizontal">
                    <h2>Журнал работы</h2>
                    <h4>Фильтр: </h4>

                    <div class="form-group">
                        <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">
                            Важность<a href="#">
                                <span class="form-question fa fa-question"></span>
                            </a>
                        </label>


                        <label class="checkbox-inline"><input type="checkbox" id="normal-priority" /> нормальная</label>
                        <label class="checkbox-inline"><input type="checkbox" id="high-priority" /> высокая</label>

                        <hr class="col-sm-12 col-md-8" />
                    </div>
                    <div class="form-group">
                        <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">
                            Дата<a href="#">
                                <span class="form-question fa fa-question"></span>
                            </a>
                        </label>

                        <div class="col-sm-6 col-md-4">
                            <div class="row" id="datetime">
                                <div class="col-xs-5">
                                    <input type="text" class="form-control input-sm" id="date">
                                </div>
                                <div class="col-xs-1 text-center">-</div>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control input-sm" id="time">
                                </div>
                            </div>
                        </div>
                        <hr class="col-sm-12 col-md-8" />
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <table class="sockets">
                            <tr>
                                <th>Важность</th>
                                <th>Дата, время</th>
                                <th>Сообщения</th>
                            </tr>
                            <tr>
                                <td class="text-center">нормальная</td>
                                <td>16.09.2015</td>
                                <td>вкл</td>
                            </tr>
                        </table>
                    </div>

                    <div class="row">
                        <hr class="col-sm-12 col-md-8" />

                        <div class="col-sm-12 col-md-8">
                            <a class="btn btn-default">Очистить журнал</a>
                            <a class="btn btn-default">Скачать журнал</a>
                        </div>
                    </div>
                </form>
@stop
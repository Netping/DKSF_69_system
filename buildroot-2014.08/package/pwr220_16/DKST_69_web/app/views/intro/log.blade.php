@section("content")
                <form class="form-horizontal">
                    <h2>Журнал работы</h2>
                    <h4>Фильтр: </h4>

                    <div class="form-group">
                        <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">
                            {{Lang::get("log.priority")}}<a href="#">
                                <span class="form-question fa fa-question"></span>
                            </a>
                        </label>


                        <label class="checkbox-inline"><input type="checkbox" id="normal-priority" /> {{Lang::get("log.normal")}}</label>
                        <label class="checkbox-inline"><input type="checkbox" id="high-priority" /> {{Lang::get("log.high")}}</label>

                        <hr class="col-sm-12 col-md-8" />
                    </div>
                    <div class="form-group">
                        <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">
                            {{Lang::get("log.date")}}<a href="#">
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
                                <th>{{Lang::get("log.priority")}}</th>
                                <th>{{Lang::get("log.date_time")}}</th>
                                <th>{{Lang::get("log.messages")}}</th>
                            </tr>
                            <tr>
                                <td class="text-center">{{Lang::get("log.normal")}}</td>
                                <td>16.09.2015</td>
                                <td>вкл</td>
                            </tr>
                        </table>
                    </div>

                    <div class="row">
                        <hr class="col-sm-12 col-md-8" />

                        <div class="col-sm-12 col-md-8">
                            <a class="btn btn-default">{{Lang::get("log.log_clear")}}</a>
                            <a class="btn btn-default">{{Lang::get("log.log_download")}}</a>
                        </div>
                    </div>
                </form>
@stop
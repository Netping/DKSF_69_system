@section("content")
            <form class="form-horizontal">
                <h2>{{Lang::get("network.network_config")}}</h2>

                <div class="form-group">
                    <label for="connection" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.inet_conn")}}<a
                            href="#"><span
                            class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-control-static" id="connection">
                            <span class="fa fa-check condition condition-on"></span> {{Lang::get("network.connected")}}
                            <span class="fa fa-times condition condition-off"></span> {{Lang::get("network.not_access")}}
                        </div>
                    </div>

                    <hr class="col-sm-12 col-md-8"/>

                    <label for="ip-address" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.ip_address")}}<a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-6 col-md-4">
                        <input type="text" class="form-control" id="ip-address" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <label for="mask" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.network_subnet")}}<a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-6 col-md-4">
                        <input type="text" class="form-control" id="mask" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <label for="gateway" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.gate")}}<a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-6 col-md-4">
                        <input type="text" class="form-control" id="gateway" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <label for="mac-address" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.mac_address")}} <a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-6 col-md-4">
                        <input type="text" class="form-control" id="mac-address" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <label for="http-port" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.http_port")}}<a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-6 col-md-4">
                        <input type="number" class="form-control" id="http-port" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <label for="snmp-port" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.snmp_port")}}<a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-6 col-md-4">
                        <input type="number" class="form-control" id="snmp-port" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <label for="dns-server-1" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.dns1")}}<a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-5 col-md-3">
                        <input type="text" class="form-control" id="dns-server-1" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <label for="dns-server-2" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.dns2")}}<a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-5 col-md-3">
                        <input type="text" class="form-control" id="dns-server-2" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1">
                        <button class="btn btn-default"><span class="fa fa-times"></span></button>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <label for="dns-server-2" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get("network.dns3")}}<a
                            href="#"><span class="form-question fa fa-question"></span></a></label>

                    <div class="col-sm-5 col-md-3">
                        <input type="text" class="form-control" id="dns-server-3" placeholder="">

                        <div class="validation-error">
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1">
                        <button class="btn btn-default"><span class="fa fa-times"></span></button>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                    <div class="col-sm-12 col-md-8 text-right">
                        <button class="btn btn-default"><span class="fa fa-plus"></span> {{Lang::get("network.add")}}</button>
                    </div>

                </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <input type="submit" class="btn btn-primary" value="{{Lang::get('network.apply')}}"/>
                        </div>
                    </div>

            </form>
@stop
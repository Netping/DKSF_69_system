@section("content")
                <h2>SNMP TRAP</h2>

                <table class="users">
                    <tr>
                        <th>
                            №
                        </th>
                        <th>
                            Название<a href="#"><span class="form-question fa fa-question"></span></a>
                        </th>
                        <th>
                            Адрес<a href="#"><span class="form-question fa fa-question"></span></a>
                        </th>
                        <th>
                            Порт<a href="#"><span class="form-question fa fa-question"></span></a>
                        </th>
                        <th>
                            Удалить
                        </th>
                    </tr>
                    <tr>
                        <td class="text-center">1</td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td class="text-center"><span class="fa fa-times"></span></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right table-no-border">
                            <button class="btn btn-default"><span class="fa fa-plus"></span> Добавить</button>
                        </td>
                    </tr>
                </table>

                <h2>SYSLOG</h2>

                <table class="users">
                    <tr>
                        <th>
                            №
                        </th>
                        <th>
                            Название<a href="#"><span class="form-question fa fa-question"></span></a>
                        </th>
                        <th>
                            Адрес<a href="#"><span class="form-question fa fa-question"></span></a>
                        </th>
                        <th>
                            Удалить
                        </th>
                    </tr>
                    <tr>
                        <td class="text-center">1</td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td class="text-center"><span class="fa fa-times"></span></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right table-no-border">
                            <button class="btn btn-default"><span class="fa fa-plus"></span> Добавить</button>
                        </td>
                    </tr>
                </table>

                <form class="form-horizontal">
                    <h2>E-mail</h2>

                    <div class="form-group">
                        <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">
                            Адрес SMTP сервера<a href="#"><span class="form-question fa fa-question"></span></a>
                        </label>

                        <div class="col-sm-6 col-md-4">
                            <input type="text" class="form-control" id="smtp-address" placeholder="">

                            <div class="validation-error">
                            </div>
                        </div>
                        <hr class="col-sm-12 col-md-8" />
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-sm-6 col-md-4 control-label text-left">
                            Порт SMTP сервера<a href="#"><span class="form-question fa fa-question"></span></a>
                        </label>

                        <div class="col-sm-6 col-md-4">
                            <input type="text" class="form-control" id="smtp-port" placeholder="">

                            <div class="validation-error">

                            </div>
                        </div>
                        <hr class="col-sm-12 col-md-8" />
                    </div>
                    <div class="form-group">
                        <label for="contacts" class="col-sm-6 col-md-4 control-label text-left">
                            TLS шифрование<a href="#"><span class="form-question fa fa-question"></span></a>
                        </label>

                        <div class="col-sm-6 col-md-4">
                            <input type="checkbox" class="checkbox" id="tls" placeholder="">

                            <div class="validation-error">

                            </div>
                        </div>
                        <hr class="col-sm-12 col-md-8" />
                    </div>
                    <div class="form-group">
                        <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">
                            Имя пользователя<a href="#"><span class="form-question fa fa-question"></span></a>
                        </label>

                        <div class="col-sm-6 col-md-4">
                            <input type="text" class="form-control" id="username" placeholder="">

                            <div class="validation-error">
                            </div>
                        </div>
                        <hr class="col-sm-12 col-md-8" />
                    </div>
                    <div class="form-group">
                        <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">
                            Пароль<a href="#"><span class="form-question fa fa-question"></span></a>
                        </label>

                        <div class="col-sm-6 col-md-4">
                            <input type="password" class="form-control" id="password" placeholder="">

                            <div class="validation-error">
                            </div>
                        </div>
                        <hr class="col-sm-12 col-md-8" />
                    </div>
                    <div class="form-group">
                        <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">
                           От кого (from:)<a href="#"><span class="form-question fa fa-question"></span></a>
                        </label>

                        <div class="col-sm-6 col-md-4">
                            <input type="text" class="form-control" id="from" placeholder="">

                            <div class="validation-error">
                            </div>
                        </div>
                        <hr class="col-sm-12 col-md-8" />
                    </div>

                    <h2>E-mail адреса:</h2>

                    <table class="users">
                        <tr>
                            <th>
                                №
                            </th>
                            <th>
                                Название<a href="#"><span class="form-question fa fa-question"></span></a>
                            </th>
                            <th>
                                Адрес<a href="#"><span class="form-question fa fa-question"></span></a>
                            </th>
                            <th>
                                Удалить
                            </th>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td><input type="text" class="form-control" /></td>
                            <td><input type="text" class="form-control" /></td>
                            <td class="text-center"><span class="fa fa-times"></span></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right table-no-border">
                                <button class="btn btn-default"><span class="fa fa-plus"></span> Добавить</button>
                            </td>
                        </tr>
                    </table>


                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <hr />
                            <input type="submit" class="btn btn-primary" value="Применить" />
                        </div>
                    </div>
                </form>
@stop
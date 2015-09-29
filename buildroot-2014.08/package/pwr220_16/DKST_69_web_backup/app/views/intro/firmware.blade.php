@section("content")
            <form class="form-horizontal">
                <h2>Настройка сетевого интерфейса</h2>

                <div class="form-group">
                    <label for="version" class="col-sm-6 col-md-4 control-label text-left">Текущая версия ПО</label>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-control-static" id="version">
                            v.112.44
                        </div>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>
                    <label for="upload-firmware" class="col-sm-6 col-md-4 control-label text-left">Новая версия</label>

                    <div class="col-sm-6 col-md-4">
                        <input type="file" class="form-control" id="upload-firmware"/>
                    </div>
                    <hr class="col-sm-12 col-md-8"/>

                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <input type="submit" class="btn btn-primary" value="Загрузить"/>
                    </div>
                </div>
            </form>
        </div>
@stop
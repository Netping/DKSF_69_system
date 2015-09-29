@section("content")
<form onsubmit="return false;" class="form-horizontal">
<h2>Общая информация</h2>

<div class="form-group">
    <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.device_name')}}<a
            href="#"><span
            class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="allSettingsSave()" type="text" class="form-control" id="hostname" placeholder="" value="{{$admin->hostname}}">

<!--         <div class="validation-error">
            Допускаются только латинские символы и буквы
        </div> -->
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>
<div class="form-group">
    <label for="location" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.device_location')}}<a
            href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="allSettingsSave()" type="text" class="form-control" id="location" value="{{$admin->location}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>
<div class="form-group">
    <label for="contacts" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.contacts')}}<a href="#"><span
            class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="allSettingsSave()" type="text" class="form-control" id="contacts" value="{{$admin->contacts}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>

<h2>{{Lang::get('admin.users')}}</h2>

<table class="users">
    <tr>
        <th>
            №
        </th>
        <th>
            {{Lang::get('admin.username')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.password')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.access_level')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.remove')}}
        </th>
    </tr>
    
    <tbody class="users_table_tbody">
        @foreach($admin_users as $user)
        <tr id="user_{{$user->id}}" data-id="{{$user->id}}">
            <td class="text-center">{{$user->id}}</td>
            <td><input type="text" class="form-control username" onkeyup="allUsersSave()" value="{{$user->username}}" /></td>
            <td><input type="password" value="{{$user->password}}" onkeyup="allUsersSave()" class="form-control password"/></td>
        <td class="text-center">
                <select class="form-control access_level" onchange="allUsersSave()">
                    @if($user->access_level =="admin")
                    <option value="admin" selected="">{{Lang::get('admin.access_level_admin')}}</option>
                    <option value="guest">{{Lang::get('admin.access_level_guest')}}</option>
                    @else
                    <option value="admin">{{Lang::get('admin.access_level_admin')}}</option>
                    <option value="guest" selected="">{{Lang::get('admin.access_level_guest')}}</option>
                    @endif
            </select>
        </td>
            <td class="text-center"><span class="fa fa-times" onclick="removeUser({{$user->id}})"></span></td>
    </tr>
        @endforeach
    </tbody>

    <tr>
        <td colspan="5" class="text-right table-no-border">
            <button class="btn btn-default" onclick="addUser();"><span class="fa fa-plus"></span> {{Lang::get('admin.add')}}</button>
        </td>
    </tr>
</table>
<h2>{{Lang::get('admin.access_config')}}</h2>

<div class="form-group">
    <label for="access_read" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.access_read')}}<a
            href="#"><span
            class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="allSettingsSave()" type="text" class="form-control" id="access_read" value="{{$admin->access_read}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>

<div class="form-group">
    <label for="access_write" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.access_write')}}<a
            href="#"><span
            class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="allSettingsSave()" type="text" class="form-control" id="access_write" value="{{$admin->access_write}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>
<div class="form-group">
    <label for="access_filter" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.access_filter')}}<a
            href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="allSettingsSave()" type="text" class="form-control" id="access_filter" value="{{$admin->access_filter}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>

<table class="users subnet_table">
    <tr>
        <th>
            №
        </th>
        <th>
            {{Lang::get('admin.access_subnet')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.remove')}}
        </th>
    </tr>

    <tbody class="subnets_table_tbody">    
        @foreach($admin_access_subnet as $subnet)
        <tr id="subnet_{{$subnet->id}}" data-id="{{$subnet->id}}">
            <td class="text-center">{{$subnet->id}}</td>
            <td><input type="text" value="{{$subnet->subnet}}" class="form-control subnet" onkeyup="allSubnetSave();" /></td>
            <td class="text-center"><span class="fa fa-times" onclick="removeSubnet({{$subnet->id}});"></span></td>
    </tr>
        @endforeach
    </tbody>

    <tr>
        <td colspan="3" class="text-right table-no-border">
            <button class="btn btn-default" onclick="addSubnet();"><span class="fa fa-plus"></span> {{Lang::get('admin.add')}}</button>
        </td>
    </tr>

</table>
<h2>{{Lang::get('admin.ntp_config')}}</h2>

<div class="form-group">
<label for="timezone" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.timezone')}}<a
        href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

<div class="col-sm-6 col-md-4">

    <select class="form-control" onchange="allSettingsSave();" id="timezone">
        <option value="-12.0"> (GMT -12:00) Эниветок, Кваджалейн </option>
        <option value="-11.0"> (GMT -11:00) Остров Мидуэй, Самоа </option>
        <option value="-10.0"> (GMT -10:00) Гавайи </option>
        <option value="-9.0"> (GMT -9:00) Аляска </option>
        <option value="-8.0"> (GMT -8:00) Тихоокеанское время (США и Канада) </option>
        <option value="-7.0"> (GMT -7:00) Горное время (США и Канада) </option>
        <option value="-6.0"> (GMT -6:00) Центральное время (США и Канада), Мехико</option>
        <option value="-5.0"> (GMT -5:00) Восточное время (США и Канада), Богота, Лима </option>
        <option value="-4.0"> (GMT -4:00) Атлантическое время (Канада), Каракас, Ла-Пас </option>
        <option value="-3.5"> (GMT -3:30) Ньюфаундленд </option>
        <option value="-3.0"> (GMT -3:00) Бразилия, Буэнос-Айрес, Джорджтаун </option>
        <option value="-2.0"> (GMT -2:00) Срединно-Атлантического </option>
        <option value="-1.0"> (GMT -1:00 час) Азорские острова, острова Зеленого Мыса </option>
        <option value="0.0"> (GMT) Время Западной Европе, Лондон, Лиссабон, Касабланка </option>
        <option value="1.0"> (GMT +1:00 час) Брюссель, Копенгаген, Мадрид, Париж </option>
        <option value="2.0"> (GMT +2:00) Киев, Калининград, Южная Африка </option>
        <option value="3.0"> (GMT +3:00) Багдад, Эр-Рияд, Москва, Санкт-Петербург</option>
        <option value="3.5"> (GMT +3:30) Тегеран </option>
        <option value="4.0"> (GMT +4:00) Абу-Даби, Мускат, Баку, Тбилиси</option>
        <option value="4.5"> (GMT +4:30) Кабул </option>
        <option value="5.0"> (GMT +5:00) Екатеринбург, Исламабад, Карачи, Ташкент</option>
        <option value="5.5"> (GMT +5:30) Бомбей, Калькутта, Мадрас, Нью-Дели</option>
        <option value="5.75"> (GMT +5:45) Катманду</option>
        <option value="6.0"> (GMT +6:00) Алматы, Дакке, Коломбо </option>
        <option value="7.0"> (GMT +7:00) Бангкок, Ханой, Джакарта</option>
        <option value="8.0"> (GMT +8:00) Пекин, Перт, Сингапур, Гонконг</option>
        <option value="9.0"> (GMT +9:00) Токио, Сеул, Осака, Саппоро, Якутск</option>
        <option value="9.5"> (GMT +9:30) Аделаида, Дарвин </option>
        <option value="10.0"> (GMT +10:00) Восточная Австралия, Гуам, Владивосток </option>
        <option value="11.0"> (GMT +11:00) Магадан, Соломоновы острова, Новая Каледония</option>
        <option value="12.0"> (GMT +12:00) Окленд, Веллингтон, Фиджи, Камчатка</option>
    </select>










</div>
<hr class="col-sm-12 col-md-8"/>
</div>
<table class="users ntp_table">
    <tr>
        <th>
            №
        </th>
        <th>
            {{Lang::get('admin.ntp_server')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.status')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.remove')}}
        </th>
    </tr>

    <tbody class="ntp_table_tbody">
        @foreach($admin_ntp_servers as $server)
        <tr id="ntp_{{$server->id}}" data-id="{{$server->id}}">
            <td class="text-center">{{$server->id}}</td>
            <td><input type="text" onkeyup="allNtpSave();" class="form-control ntp" value="{{$server->ntp_server}}"/></td>
            <td class="text-center"><span class="italic">{{Lang::get('admin.not_connect')}}</span>
                <button class="refresh" onclick="javascript:ntpRefresh({{$server->id}});"><span class="fa fa-refresh"></span></button>
        </td>
            <td class="text-center"><span class="fa fa-times" onclick="removeNtp({{$server->id}});"></span></td>
    </tr>
        @endforeach
    </tbody>

    <tr>
        <td colspan="4" class="text-right table-no-border">
            <button class="btn btn-default" onclick="addNtp();"><span class="fa fa-plus"></span> {{Lang::get('admin.add')}}</button>
        </td>
    </tr>
</table>
<h2>{{Lang::get('admin.rtc')}}</h2>

<div class="form-group">
    <label for="date" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.date_time')}}<a
            href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <p class="form-control-static"><span id="showDate">{{date("d.m.Y",time() - $admin->datetime_offset)}}</span>, <span id="showTime">{{date("G:i:s",time() - $admin->datetime_offset)}}</span>
            <button class="datetime-edit" onclick="showChangeDateTime();"><span class="fa fa-pencil"></span></button>
        </p>

        <div class="row hidden" id="datetime">
            <div class="col-xs-5">
                <input onkeyup="dateTimeChange()" type="text" class="form-control input-sm" id="date" value="" placeholder="">
            </div>
            <div class="col-xs-5">
                <input onkeyup="dateTimeChange()" type="text" class="form-control input-sm" id="time" value="" placeholder="">
            </div>
            <div class="col-xs-2">
                <button class="btn btn-default btn-sm" onclick="hideChangeDateTime()"><span class="fa fa-times"></span></button>
            </div>
        </div>
    </div>
</div>
<div class="validation-error">

</div>

</form>
</div>
@stop

@section("add_js")
<script type="text/javascript">


var datetime_offset = parseInt({{$admin->datetime_offset}})*1000;

$(document).ready(function()
{
    $.each($("#timezone option"),function(index,value)
    {
        if( $(value).val() == '{{$admin->timezone}}' )
        {
            $("#timezone").val('{{$admin->timezone}}');
        }
    });

    //запускаем часы
    startTime();
});


//анимация часов
var t;
function startTime()
{
    console.log("startTime");

    var currentTime = (Date.now() - (datetime_offset) );
    var tm=new Date(currentTime);
    var h=tm.getHours();
    var m=tm.getMinutes();
    var s=tm.getSeconds();
    m=checkTime(m);
    s=checkTime(s);

    $("#showTime").html( h+":"+m+":"+s );
    $("#time").html( h+":"+m+":"+s );

    t=setTimeout('startTime()',500);
}

function checkTime(i)
{
    if (i<10)
    {
    i="0" + i;
    }
    return i;
}
//


function allSettingsSave () {
    console.log("allSettingsSave",datetime_offset);
    var jsonData = {};
    jsonData.hostname = $("#hostname").val();
    jsonData.location = $("#location").val();
    jsonData.contacts = $("#contacts").val();
    jsonData.access_read = $("#access_read").val();
    jsonData.access_write = $("#access_write").val();
    jsonData.access_filter = $("#access_filter").val();
    jsonData.timezone = $("#timezone option:selected").val();
    jsonData.datetime_offset = parseInt( datetime_offset / 1000 );
    // jsonData.date = $("#date").val();
    // jsonData.time = $("#time").val();

    console.log(jsonData);

    $.ajax({
        url:"admin/save",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });
}

function allUsersSave () {

    var jsonData = {};
    jsonData.users = [];
    $.each($(".users_table_tbody tr"),function(index,value)
    {
        jsonData.users.push( { id:$(value).attr("data-id"), 
            username:$(value).find(".username").val(),
            password:$(value).find(".password").val(),
            access_level:$(value).find(".access_level").val()
         } );
        // console.log(index,value);
    });
    
    $.ajax({
        url:"admin/save/users",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });
}


function allSubnetSave()
{
    var jsonData = {};
    jsonData.subnets = [];
    $.each($(".subnets_table_tbody tr"),function(index,value)
    {
        jsonData.subnets.push( { id:$(value).attr("data-id"), 
            subnet:$(value).find(".subnet").val()
         } );
    });
    
    console.log(jsonData);
    // return false;

    $.ajax({
        url:"admin/save/subnets",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });
}

function allNtpSave()
{
    var jsonData = {};
    jsonData.ntps = [];
    $.each($(".ntp_table_tbody tr"),function(index,value)
    {
        jsonData.ntps.push( { id:$(value).attr("data-id"), 
            ntp:$(value).find(".ntp").val()
         } );
    });
    
    console.log(jsonData);
    // return false;

    $.ajax({
        url:"admin/save/ntps",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });
}



var usersNum = {{count($admin_users)}};
function addUser()
{
    usersNum++;
    var userRow = "<tr id=user_"+usersNum+" data-id='"+usersNum+"'>"+
        '<td class="text-center">'+usersNum+'</td>'+
        '<td><input type="text" onkeyup="allUsersSave()" class="form-control username" value="" /></td>'+
        '<td><input type="password" onkeyup="allUsersSave()" value="" class="form-control password"/></td>'+
        '<td class="text-center">'+
            '<select class="form-control access_level" onchange="allUsersSave()">'+
                "<option value='admin'>{{Lang::get('admin.access_level_admin')}}</option>"+
                "<option value='guest'>{{Lang::get('admin.access_level_guest')}}</option>"+
            '</select>'+
        "</td>"+
        '<td class="text-center"><span class="fa fa-times" onclick="removeUser('+usersNum+')"></span></td>'+
    "</tr>";

    $(".users_table_tbody").append(userRow);

    //send to server
    allUsersSave();
}

function removeUser(id)
{
    console.log("removeUser");
    usersNum--;
    $("#user_"+id).remove();

    //send to server
    allUsersSave();
}

var subnetsNum = {{count($admin_access_subnet)}};
function addSubnet()
{
    subnetsNum++;

    var subnetRow = '<tr id="subnet_'+subnetsNum+'" data-id="'+subnetsNum+'">'+
        '<td class="text-center">'+subnetsNum+'</td>'+
        '<td><input type="text" onkeyup="allSubnetSave();" value="" class="form-control subnet"/></td>'+
        '<td class="text-center"><span class="fa fa-times" onclick="removeSubnet('+subnetsNum+');"></span></td>'+
    '</tr>';

    $(".subnets_table_tbody").append(subnetRow);

    //send to server
    allSubnetSave();
}

function removeSubnet(id)
{
    subnetsNum--;
    $("#subnet_"+id).remove();

    //send to server
    allSubnetSave();
}


var ntpNum = {{count($admin_ntp_servers)}};
function addNtp()
{
    ntpNum++;

    var ntpRow = '<tr id="ntp_'+ntpNum+'" data-id="'+ntpNum+'">'+
            '<td class="text-center">'+ntpNum+'</td>'+
            '<td><input type="text" onkeyup="allNtpSave();" class="form-control ntp" value=""/></td>'+
            "<td class='text-center'><span class='italic'>{{Lang::get('admin.not_connect')}}</span>"+
                '<button class="refresh" onclick="javascript:ntp_refresh('+ntpNum+');"><span class="fa fa-refresh"></span></button>'+
            '</td>'+
            '<td class="text-center"><span class="fa fa-times" onclick="removeNtp('+ntpNum+')"></span></td>'+
        '</tr>';


    $(".ntp_table_tbody").append(ntpRow);

    //send to server
    allNtpSave();
}

function removeNtp(id)
{
    console.log("removeNtp");
    ntpNum--;
    $("#ntp_"+id).remove();

    //send to server
    allNtpSave();
}

function ntpRefresh(id)
{
    console.log("ntpRefresh");
}

function showChangeDateTime()
{
    $("#datetime").removeClass("hidden");
    $("#date").val( $("#showDate").text() );
    $("#time").val( $("#showTime").text() );
    clearTimeout(t);
}

function hideChangeDateTime()
{
    $("#datetime").addClass("hidden");

    var curDate = $("#date").val();
    var date_arr = curDate.split(".");

    console.log(date_arr);

    var newDatetime = new Date(date_arr[1]+"/"+date_arr[0]+"/"+date_arr[2]+" "+ $("#time").val() );//+" "+$("#time").val()).getTime();
    

    datetime_offset = Date.now() - newDatetime;

    console.log(curDate,datetime_offset);

    startTime();

    allSettingsSave();
}

function dateTimeChange()
{
    console.log("dateTimeChange");
    $("#showDate").html( $("#date").val() );
    $("#showTime").html( $("#time").val() );

    // allSettingsSave();
}

</script>


@stop
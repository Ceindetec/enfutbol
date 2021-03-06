@extends('layouts.principal')

@section('css')
    {!!Html::style('plugins/datatables/dataTables.bootstrap.css')!!}
    {!!Html::style('plugins/autocompletar/autocompletar.css')!!}
    <style>
        .nuevo:hover{
            color: blue;
        }
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .image-preview-input-title {
            margin-left:2px;
        }
        .pointer, .aceptar, .rechazar{
            cursor: pointer;
        }
        textarea{
            resize: none;
        }
        .premiado{
            margin-top: 5px;
        }
        .popover{
            background-color: white !important;
            /*width: 100% !important;*/
        }
        .popover-title {
            background-color: #337ab7 !important;
            color: white !important;
        }

        .editProfPic{
            position:absolute;
            top:15px;
            z-index:1;
            text-align: right;
            /*padding-top: 9px;*/
            /*color: #a10000;*/
            right: 10px;
            /*margin-right: 20px;*/
        }
        .panel-equipo{
            position: relative;
        }
        .confirmation .popover-content {
            width: 100%;
        }

        .btn-xs{
            padding: 4px 10px;
        }
        .confirmation-content{
            color: #0c0c0c;
            font-size: 13px;
        }
        .panel-equipo, .nuevo, .planear {
            -webkit-transition:all .9s ease; /* Safari y Chrome */
            -moz-transition:all .9s ease; /* Firefox */
            -o-transition:all .9s ease; /* IE 9 */
            -ms-transition:all .9s ease;
        }
        .panel-equipo:hover, .nuevo:hover, .planear:hover{
            -webkit-transform:scale(1.13);
            -moz-transform:scale(1.13);
            -ms-transform:scale(1.13);
            -o-transform:scale(1.13);
            transform:scale(1.13);
            z-index: 1000000;
        }
        .aceptar:hover{
            color: green;
        }
        .rechazar:hover{
            color: red;
        }
        .eliminar{
            background-color: white;
            border-radius: 50%;
            padding: 5px;
        }
        .eliminar:hover{
            color: red;
        }
        .titulo{
            margin-bottom: 10px;
            font-size: 17px;
        }
        .planear:hover > .resaltar{
            text-decoration: underline;
        }
        .question:hover{
            color: #003eff;
        }
    </style>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h4>Administrar torneo</h4>
                </div>
                <div class="panel-body">
                    @if($torneo->maxFecha_inscripcion > date('Y-m-d'))
                        {!!Form::open(['id'=>'formTorneo', 'autocomplete'=>'off', 'class'=>'form-horizontal'])!!}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre" class="col-md-2 control-label">Nombre</label>
                                    <div class="col-md-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-trophy"></i>
                                            </div>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del torneo.." value="{{$torneo->nombre}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="col-md-2 control-label">Descripción</label>
                                    <div class="col-md-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-comments"></i>
                                            </div>
                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="4" placeholder="Caracteristicas del torneo.." required>{!!$torneo->descripcion!!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="url_logo" class="col-md-2 control-label">Imagen</label>
                                    <div class="col-md-10">
                                        <div class="input-group image-preview">
                                            <input type="text" class="form-control image-preview-filename" placeholder="Selecciona una nueva imagen &#10140;" disabled="disabled">
                                        <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Cancelar
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title">Cambiar</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="url_logo" id="url_logo"/>
                                            </div>
                                        </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 text-center">
                                <img src="/images/torneos/{!!$torneo->url_logo!!}" width="70%" height="195px" id="imagen">
                            </div>

                            <div class="col-xs-12 text-center" style="margin-top:15px">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Guardar <i class="fa fa-check hidden" id="icono"></i></button>
                                </div>
                            </div>
                        {!!Form::close()!!}
                    @else
                        @if($torneo->estado == "A")
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="alert alert-warning text-center manito planear" role="alert">
                                    <div class="titulo">
                                        <b>ATENCION!</b>
                                    </div>
                                    El tiempo de inscripción al torneo, ha terminado <br>
                                    <b class="resaltar">INICIAR PLANEACION</b>
                                </div>
                            </div>
                        @else

                        @endif

                    @endif

                    <div class="col-xs-12" id="equipos_ins">
                        <h2 style="margin-bottom: 15px">Equipos inscritos</h2>
                        @if($torneo->estado == "A")
                            <div class="col-xs-4 col-sm-4 col-md-2" id="padreNuevo">
                                <div class="panel panel-default pointer nuevo">
                                    <div class="panel-body" style="padding: 49px 0;">
                                        <center>
                                            <i class="fa fa-plus-square fa-4x"></i>
                                            <div style="padding-top: 5px">Registrar Equipo</div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @foreach($torneo->getEquipos_torneo as $equipo)
                            @if($equipo->estado == 'A')
                                <div class="col-xs-4 col-sm-4 col-md-2 conte-equipo">
                                    <div class="panel pointer panel-equipo" data-equipo="{{$equipo->id}}">

                                        @if($torneo->estado == "A")
                                            <div class="editProfPic">
                                                <i class='fa fa-trash fa-2x eliminar manito' aria-hidden='true' data-toggle='confirmation' data-singleton="true" data-placement='left' title='Eliminar?'  data-content="Esta accion no se podra deshacer, continuar?:" data-btn-ok-label="Si" data-btn-cancel-label="No"></i>
                                            </div>
                                        @endif

                                        <div class="equipo">
                                            <div class="panel-body" style="padding: 0;">
                                                <center>
                                                    <img src="/images/torneos/escudos/{{$equipo->getEquipo->getEscudo->url}}" width="100%" height="140px">
                                                </center>
                                            </div>
                                            <div class="panel-footer">
                                                <b>{{$equipo->getEquipo->nombre}}</b><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if(isset($solicitudes))
                        <div class="col-xs-12">
                            <h2 style="margin-bottom: 15px">Solicitudes de inscripcion</h2>

                            <table id="solicitudes" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">Equipo</th>
                                    <th class="text-center">Capitan</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($torneo->getEquipos_torneo as $solicitud)
                                    @if($solicitud->estado == 'P' || $solicitud->estado == 'R')
                                        <tr class="fila">
                                            <td>{{$solicitud->getEquipo->nombre}}</td>
                                            <td>{{$solicitud->getEquipo->getCapitan->getPersona->nombres}}</td>
                                            <td class="estado">{{($solicitud->estado == 'P')?'Pendiente':'Rechazada'}}</td>
                                            <td class="text-center" data-solicitud="{{$solicitud->id}}">
                                                <i class="fa fa-check-circle-o fa-2x aceptar" data-toggle='tooltip' data-popout='true' data-placement='top' title="Aceptar"></i>
                                                @if($solicitud->estado == 'P')
                                                    &nbsp;<i class="fa fa-times-circle-o fa-2x rechazar" data-toggle='tooltip' data-popout='true' data-placement='top' title="Rechazar"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <div class="modal-body" id="content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal" id="botonModal">Entendido!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registrarEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Inscribir equipo</h4>
                </div>
                <div class="modal-body">
                    @if($torneo->privacidad == 'C')
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#crear">Crear Equipo &nbsp;<i class="fa fa-question-circle question" data-toggle='tooltip' data-popout='true' data-placement='bottom' title="Crea un nuevo equipo e inscribelo directamente al torneo."></i></a></li>
                            <li><a data-toggle="tab" href="#codigo">Generar Codigo &nbsp;<i class="fa fa-question-circle question" data-toggle='tooltip' data-popout='true' data-placement='bottom' title="Invita a un usuario a inscribir a su equipo mediante un codigo."></i></a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="crear" class="tab-pane fade in active">
                                <div class="form-horizontal" style="margin-top: 15px">
                                    <div class="form-group">
                                        <label for="equipo" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control nuevoEquipo" id="equipo" placeholder="Nombre equipo.." required>
                                        </div>
                                    </div>

                                    {!!Form::open(['id'=>'formIntegrante','class'=>'form-horizontal','autocomplete'=>'off'])!!}
                                        <div class="form-group" style="margin-bottom: 20px">
                                            {!! Form::label('autocompletar', 'Capitan',['class'=>'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!!Form::text('user',null,['id'=>'autocompletar','class'=>'form-control nuevoEquipo autocompletar','placeholder'=>"Identificacion o usuario", 'required'])!!}
                                            </div>
                                            {!!Form::text('user_id',null,['id'=>'user_id','class'=>'form-control hidden user_id'])!!}
                                        </div>
                                    {!!Form::close()!!}

                                    <div class="form-group text-right">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary" id="creaEquipo" disabled>Terminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="codigo" class="tab-pane fade">
                                <div class="form-horizontal" style="margin-top: 15px">
                                    {!!Form::open(['id'=>'formIntegrante','class'=>'form-horizontal','autocomplete'=>'off'])!!}
                                        <div class="form-group" style="margin-bottom: 20px">
                                            {!! Form::label('autocompletar', 'Capitan',['class'=>'col-sm-2 control-label']) !!}
                                            <div class="col-sm-10">
                                                {!!Form::text('user',null,['id'=>'user','class'=>'form-control autocompletar','placeholder'=>"Identificacion o usuario", 'required'])!!}
                                            </div>
                                            {!!Form::text('capitan',null,['id'=>'capitan','class'=>'form-control hidden user_id'])!!}
                                        </div>
                                    {!!Form::close()!!}

                                    <div class="form-group">
                                        <label for="serieCodigo" class="col-sm-2 control-label">Codigo</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control " id="serieCodigo" disabled>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-default" id="generar">Generar</button>
                                        </div>
                                    </div>

                                    <div class="form-group text-right">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary" id="creaCodigo" disabled>Enviar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @else
                        <div class="form-horizontal" style="margin-top: 15px">
                            <div class="form-group">
                                <label for="equipo" class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control nuevoEquipo" id="equipo" placeholder="Nombre equipo.." required>
                                </div>
                            </div>

                            {!!Form::open(['id'=>'formIntegrante','class'=>'form-horizontal','autocomplete'=>'off'])!!}
                            <div class="form-group" style="margin-bottom: 20px">
                                {!! Form::label('autocompletar', 'Capitan',['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!!Form::text('user',null,['id'=>'autocompletar','class'=>'form-control nuevoEquipo autocompletar','placeholder'=>"Identificacion o usuario", 'required'])!!}
                                </div>
                                {!!Form::text('user_id',null,['id'=>'user_id','class'=>'form-control hidden user_id'])!!}
                            </div>
                            {!!Form::close()!!}

                            <div class="form-group text-right">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" id="creaEquipo" disabled>Terminar</button>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="alert alert-danger alert-dismissable hidden" id="notificar">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Atencion!</strong>&nbsp;<span id="mensaje"></span>
                    </div>
                </div>
                {{--<div class="modal-footer">--}}
                    {{----}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection


@section('js')
    {!!Html::script('plugins/bootstrapConfirmation/bootstrap-confirmation.min.js')!!}
    {!!Html::script('plugins/datatables/jquery.dataTables.min.js')!!}
    {!!Html::script('plugins/datatables/dataTables.bootstrap.min.js')!!}
    {!!Html::script('plugins/autocompletar/jquery.mockjax.js')!!}
    {!!Html::script('plugins/autocompletar/jquery.autocomplete.js')!!}
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $('#solicitudes').DataTable( {
                "language": {
                    "lengthMenu": "Mostrar  _MENU_ Solicitudes por Página",
                    "zeroRecords": "Ningun registro",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay solicitudes",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            } );

            $(".eliminar").each(function(){
                $(this).confirmation({
                    onConfirm: function () {
                        rechazarEquipo($(this).parents('.panel-equipo').data('equipo'), 'E', $(this).parents('.conte-equipo'));
                    }
                });
            });

            var closebtn = $('<button/>', {
                type:"button",
                text: 'x',
                id: 'close-preview',
                style: 'font-size: initial;'
            });
            closebtn.attr("class","close pull-right");
            // Set the popover default content
            $('.image-preview').popover({
                trigger:'manual',
                html:true,
                title: "<strong>Vista previa</strong>"+$(closebtn)[0].outerHTML,
                content: "There's no image",
                placement:'bottom'
            });
            // Clear event
            $('.image-preview-clear').click(function(){
                $('.image-preview').attr("data-content","").popover('hide');
                $('.image-preview-filename').val("");
                $('.image-preview-clear').hide();
                $('.image-preview-input input:file').val("");
                $(".image-preview-input-title").text("Cambiar");
            });
            // Create the preview image
            $(".image-preview-input input:file").change(function (){
                var img = $('<img/>', {
                    id: 'dynamic',
                    width:250,
                    height:200
                });
                var file = this.files[0];
                var reader = new FileReader();
                // Set preview image into the popover data-content
                reader.onload = function (e) {
                    $(".image-preview-input-title").text("Cambiar");
                    $(".image-preview-clear").show();
                    $(".image-preview-filename").val(file.name);
                    img.attr('src', e.target.result);
                    $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                };
                reader.readAsDataURL(file);
            });


        });

        $(".planear").on('click', function(){
            $.ajax({
                type: "POST",
                url: '{{route('iniciarTorneo')}}',
                data: {torneo:'{{$torneo->id}}'},
                success: function (data) {
                    if(data.estado){
                        window.location = '{{route('adminFases', $torneo->id)}}';
                    }
                    else{
                        $("#modal-title").html("Error!").parents('.modal-header').addClass('alert-danger');
                        $("#content").html(data.mensaje);
                        $("#botonModal").addClass('btn-danger');
                        $("#notifModal").modal("show");
                    }
                },
                error: function () {

                }
            });
        });

        $("#formTorneo").on('submit', function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            formData.append('torneo_id', '{{$torneo->id}}');
            $.ajax({
                type: "POST",
                url: '{{route('updateTorneo')}}',
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                success: function (data) {
                    if(data.estado){
                        $("#icono").removeClass('hidden');
                        if(data.mensaje != 'exito'){
                            $("#imagen").attr('src', '/images/torneos/' + data.mensaje);
                            $('.image-preview').attr("data-content","").popover('hide');
                            $('.image-preview-filename').val("");
                            $('.image-preview-clear').hide();
                            $('.image-preview-input input:file').val("");
                            $(".image-preview-input-title").text("Cambiar");
                        }
                    }
                    else {
                        $("#modal-title").html("Error!").parents('.modal-header').addClass('alert-danger');
                        $("#content").html(data.mensaje);
                        $("#botonModal").addClass('btn-danger');
                        $("#notifModal").modal("show");
                    }
                },
                error: function () {

                }
            });
        });

        $(document).on('click', '#close-preview', function(){
            $('.image-preview').popover('hide');
            // Hover befor close the preview
            $('.image-preview').hover(
                    function () {
                        $('.image-preview').popover('show');
                    },
                    function () {
                        $('.image-preview').popover('hide');
                    }
            );
        });

        $("#solicitudes").on('click', '.aceptar', function () {
            var elemento = $(this);
            $.ajax({
                type: "POST",
                url: '{{route('aceptarSolicitud')}}',
                data: {'solicitud':elemento.parent().data('solicitud'), 'torneo':'{{$torneo->id}}'},
                success: function (data) {
                    if(data.estado){
                        elemento.parents('.fila').remove();
                        var html = "<div class='col-xs-4 col-sm-4 col-md-2 conte-equipo'>" +
                                        "<div class='panel pointer panel-equipo' data-equipo='"+data.mensaje['id']+"'>";
                        if('{{$torneo->estado}}' == "A")
                            html = html + "<div class='editProfPic'>" +
                                    "<i class='fa fa-trash fa-2x eliminar manito' aria-hidden='true' data-toggle='confirmation' data-singleton='true' data-placement='left' title='Eliminar?'  data-content='Esta accion no se podra deshacer, continuar?:' data-btn-ok-label='Si' data-btn-cancel-label='No'></i>" +
                                    "</div>" ;

                        html = html + "<div class='equipo'>" +
                                                "<div class='panel-body' style='padding: 0;'>" +
                                                    "<center>" +
                                                        "<img src='/images/torneos/escudos/"+data.mensaje['get_equipo']['get_escudo']['url']+"' width='100%'' height='140px'>" +
                                                    "</center>" +
                                                "</div>" +
                                                "<div class='panel-footer'>" +
                                                    "<b>"+data.mensaje['get_equipo']['nombre']+"</b><br>" +
                                                "</div>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>";
                        $('#equipos_ins').append(html);
                    }
                    else {
                        $("#modal-title").html("Atencion!").parents('.modal-header').addClass('alert-danger');
                        $("#content").html(data.mensaje);
                        $("#botonModal").addClass('btn-danger');
                        $("#notifModal").modal("show");
                    }
                },
                error: function () {

                }
            });
        });

        $("#solicitudes").on('click', '.rechazar', function () {
            var elemento = $(this);
            rechazarEquipo(elemento.parent().data('solicitud'), 'R', elemento);
        });

        $("#equipos_ins").on('click', '.eliminar', function(){
            $(this).confirmation({
                onConfirm: function () {
                    rechazarEquipo($(this).parents('.panel-equipo').data('equipo'), 'E', $(this).parents('.conte-equipo'));
                }
            });
        }).on('click', '.equipo', function(){
            window.location = '/adminEquipo/' + $(this).parent().data('equipo');
        });

        function rechazarEquipo(id_solicitud, accion, elemento){
            $.ajax({
                type: "POST",
                url: '{{route('rechazarSolicitud')}}',
                data: {'solicitud':id_solicitud, 'torneo':'{{$torneo->id}}'},
                success: function (data) {
                    if(data.estado){
                        if(accion == 'R'){
                            elemento.parent().siblings('.estado').html('Rechazado');
                            elemento.remove();
                        }
                        else {
                            var html = "<tr class='fila'>" +
                                            "<td>"+data.mensaje['get_equipo']['nombre']+"</td>" +
                                            "<td>"+data.mensaje['get_equipo']['get_capitan']['get_persona']['nombres']+"</td>" +
                                            "<td class='estado'>";
                            if(data.mensaje['estado'] == 'P')
                                html = html + "Pendiente";
                            else
                                html = html + "Rechazada";

                            html = html + "</td>" +
                                            "<td class='text-center' data-solicitud='"+data.mensaje['id']+"'>" +
                                                "<i class='fa fa-check-circle-o fa-2x aceptar' data-toggle='tooltip' data-popout='true' data-placement='top' title='Aceptar'></i>";

                            if(data.mensaje['estado'] == 'P')
                                html = html + "&nbsp;<i class='fa fa-times-circle-o fa-2x rechazar' data-toggle='tooltip' data-popout='true' data-placement='top' title='Rechazar'></i>" +
                                        "</td>" +
                                        "</tr>";
                            $('#solicitudes').children('tbody').append(html);
                            elemento.remove();
                        }
                    }
                    else {
                        $("#modal-title").html("Atencion!").parents('.modal-header').addClass('alert-danger');
                        $("#content").html(data.mensaje);
                        $("#botonModal").addClass('btn-danger');
                        $("#notifModal").modal("show");
                    }
                },
                error: function (data) {
                    $("#modal-title").html("Atencion!").parents('.modal-header').addClass('alert-danger');
                    $("#content").html(data.mensaje);
                    $("#botonModal").addClass('btn-danger');
                    $("#notifModal").modal("show");
                }
            });
        }
        
        $('#padreNuevo').on('click', function(){
            $("#registrarEquipo").modal("show");
            iniciarAutoComplete();
        });

        function iniciarAutoComplete(){
            $('.autocompletar').autocomplete({
                serviceUrl: '{{route("autoCompleUser")}}',
                lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                    var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                    return re.test(suggestion.value);
                },
                onSelect: function(suggestion) {
                    $(".user_id").val(suggestion.data);
                },
                onHint: function (hint) {
                    $('#autocomplete-ajax-x').val(hint);
                },
                onInvalidateSelection: function() {
                    $(".user_id").val("");
                }
            });
        }
        
        $("#creaEquipo").on('click', function(){
            if($("#equipo").val() != "" && $("#user_id").val() != ""){
                var torneo_id='{{$torneo->id}}';
                $.ajax({
                    type:"POST",
                    context: document.body,
                    url: '{{route('addEquipoTorneo')}}',
                    data: {equipo:$("#equipo").val(), capitan:$("#user_id").val(), torneo_id:torneo_id},
                    success: function(data){
                        if(data.estado){
                            var html = '<div class="col-xs-4 col-sm-4 col-md-2 conte-equipo">' +
                                            '<div class="panel pointer panel-equipo" data-equipo="'+data.mensaje['id']+'">';
                            if('{{$torneo->estado}}' == "A"){
                                html = html + '<div class="editProfPic">' +
                                                    '<i class="fa fa-trash fa-2x eliminar manito" aria-hidden="true" data-toggle="confirmation" data-singleton="true" data-placement="left" title="Eliminar?"  data-content="Esta accion no se podra deshacer, continuar?:" data-btn-ok-label="Si" data-btn-cancel-label="No"></i>' +
                                                '</div>';
                            }

                            html = html + '<div class="equipo">' +
                                            '<div class="panel-body" style="padding:0;">' +
                                                '<center>' +
                                                    '<img src="/images/torneos/escudos/'+data.mensaje['get_equipo']['get_escudo']['url']+'" width="100%" height="140px">' +
                                                '</center>' +
                                            '</div>' +
                                            '<div class="panel-footer">' +
                                                '<b>'+data.mensaje['get_equipo']['nombre']+'</b><br>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>';
                            $("#equipos_ins").append(html);
                            $("#equipo").val('');
                            $('#registrarEquipo').modal('toggle');
                        }
                        else {
                            $("#mensaje").html(data.mensaje);
                            $("#notificar").removeClass('hidden');
                            $("#creaEquipo").attr('disabled', true);
                        }
                        $("#autocompletar").val('');
                        $("#user_id").val('');
                    },
                    error: function(data){

                    }
                });
            }
        });
        
        $('.nuevoEquipo').on('blur', function(){
            if($("#equipo").val()!='' && $("#user_id").val()!=''){
                $("#creaEquipo").removeAttr('disabled');
            }
            else{
                $("#creaEquipo").attr('disabled', true);
            }
        });

        $("#user").on('blur', function(){
            if($("#capitan").val()!='' && $("#serieCodigo").val()!='')
                $("#creaCodigo").removeAttr('disabled');
            else
                $("#creaCodigo").attr('disabled', true);
        });

        $("#registrarEquipo").on('hidden.bs.modal', function(){
            $("#equipo").val('');
            $("#autocompletar").val('');
            $("#user").val('');
            $("#serieCodigo").val('');
            $(".user_id").val('');
            $("#mensaje").html('');
            $("#generar").parent().removeClass('hidden');
            $("#notificar").addClass('hidden').removeClass('alert-success').addClass('alert-danger');

            $("#creaEquipo").attr('disabled', true);
            $("#creaCodigo").attr('disabled', true);
        });

        function createCode(){
            var code = "";
            var posibilidades = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for( var i=0; i < 6; i++ )
                code += posibilidades.charAt(Math.floor(Math.random() * posibilidades.length));
            return code;
        }

        $("#generar").on('click', function(){
            $("#serieCodigo").val(createCode());
            $("#generar").parent().addClass('hidden');
            if($("#capitan").val() != ''){
                $("#creaCodigo").removeAttr('disabled');
            }
        });

        $("#creaCodigo").on('click', function(){
            if($("#capitan").val() != ""){
                var torneo_id='{{$torneo->id}}';
                var codigo = $("#serieCodigo").val();
                $.ajax({
                    type:"POST",
                    context: document.body,
                    url: '{{route('generarCodigo')}}',
                    data: {capitan:$("#capitan").val(), torneo_id:torneo_id, codigo:codigo},
                    success: function(data){
                        if(data.estado){
                            $("#mensaje").html('El codigo para inscripcion de equipo fue enviado exitosamente al usuario!');
                            $("#notificar").removeClass('hidden').removeClass('alert-danger').addClass('alert-success');
                            setTimeout(function(){
                                $('#registrarEquipo').modal('toggle');
                            }, 5000);
                        }
                        else {
                            $("#mensaje").html(data.mensaje);
                            $("#notificar").removeClass('hidden');
                            $("#creaCodigo").attr('disabled', true);
                        }
                        $("#user").val('');
                        $("#capitan").val('');
                    },
                    error: function(data){

                    }
                });
            }
        });
    </script>
@endsection
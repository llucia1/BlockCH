var Calendar = {

    Start: function() {

        AddClassDays();

        if($('input[name="comercial"]').length)
        {
            var id = $('input[name="comercial"]').attr('id');
            addEventCalendar(date = $('.calendar').attr('id'),userlist = id); 
        }

        if(rol == 7)
        {
            var user_list = "";

            $('.users').each(function(){

                 user_list += $(this).val()+',';

            });

            user_list = user_list.substring(0, user_list.length-1);

            //alert(user_list);
            addEventCalendar(date = $('.calendar').attr('id'),user_list,1,1);
        }
        

     },

    NextPrev: function() {

        $('body').on('click', '.heading_row_start a', function(e){

            e.preventDefault();

            $( '.calendar' ).css( "opacity", "0.3" );
            $( '#content-calendar' ).append('<p style="position:absolute; top:50%; width: 100%; float: left; text-align: center;"><img src="'+base_url+'assets/apps/img/ajax-loader.gif"/></p>');

            var uri = $(this).attr('href');
            var date = uri.split("/");
            date = date[7]+'-'+date[8];
            var id = false;

            var type = 'POST';
            var url = uri;
            var data = {};

            var returndata = ActionAjax(type,url,data,null,null,true,false);

            $('#content-calendar').html(returndata);
            AddClassDays();

            if($('input[name="comercial"]').length)
            {
                id = $('input[name="comercial"]').attr('id');
            }
            
            addEventCalendar(date,id);
            
    	});

    },

    CheckboxUser: function(){

        $('.users').click(function(){

            var date = $('.calendar').attr('id');
            var cd = $(this).data('cd');

            $('.only-check').prop('checked', false);
            //si cd == 0 checkout los cd
            if(cd == 0){

                $('.users-cd').attr('checked', false);

            }else if(cd == 1)
            {
                $('.users-user').attr('checked', false);
            }

            addEventCalendar(date,false,cd);

        });

     },

     ShowEventsList: function(){

        $('body').on('click', '.btn-event', function(){


            var id = $(this).attr('id');
            var date = $('.calendar').attr('id');
            var day = $(this).data('day');

            var type = 'POST';
            var url = site_url+'/calendario/get_events_list';
            var data = {'id':id,'date':date,'day':day};

            var eventsL = ActionAjax(type,url,data,null,null,true,false);
            eventsL = JSON.parse(eventsL);

            $('.modal-title').text('Listado de eventos '+eventsL[0].idusuario.nombre+' '+eventsL[0].idusuario.apellidos);
            getTableEvent(eventsL,date,day);
            $('#table-calendar').show();
            $('#form-edit').hide();
            $('#eventoslistModal').modal('show');
            

        });

     },

     ShowEventsDetail: function(){

        $('body').on('click', '.btn-event', function(){

            if ($(this).hasClass('activo')){

                var id = $(this).attr('id');
                var date = $('.calendar').attr('id');
                var day = $(this).data('day');

                var today = new Date();
                //almacenamos el v. año, mes, día y hora+minutos
                var year = today.getFullYear();
                var month = today.getMonth();
                var day = today.getUTCDate();
                var minutes = (today.getMinutes()<10?'0':'') + today.getMinutes();
                var hour = parseFloat(today.getHours()+'.'+minutes);

                var type = 'POST';
                var url = site_url+'/calendario/get_event_detail';
                var data = {'id':id,'date':date,'day':day};

                var eventDe = ActionAjax(type,url,data,null,null,true,false);
                eventDe = JSON.parse(eventDe);

                var html = getEventDetails(eventDe);

                $('.modal-title').html('Evento: <a target="_blank" href="'+site_url+'/clientes/edit/'+eventDe['calendar'][0].cl_id+'">'+eventDe['calendar'][0].cl_nombre)+'</a>';
                //Si el estado del calendario es == 0 y rol es igual a 3 = comercial, mostramos la vista de comercial.
                //pero si el rol del usuario es igual que al logeado 7 -7, este aún siendo director comercial, podra ver dicha vista
                //ya que entendemos que esta visualizando su propio calendario con permisos de comercial
                if((!eventDe['calendar'][0].c_estado && rol == 3) || (!eventDe['calendar'][0].c_estado && eventDe['calendar'][0].r_id) == 7){

                    html +='<div class="col-md-12"><h4><strong>Petición de cobertura</strong></h4></div>';

                    html +='<input type="hidden" name="submit-reporte-calendario" value="1">';

                    html +='<div class="form-group col-md-12">';
                    html +='<label>Realizar petición</label>';
                    html +='<select name="peticion-cobertura" class="form-control peticion-cobertura">';
                    html +='<option value="0">No</option>';
                    html +='<option value="1">Si</option>';
                    html +='</select>';
                    html +='</div>';

                    html +='<div style="display:none;" class="form-group col-md-12 direcciones-coberturas">';
                    html +='<label>Escribe la dirección o direcciones</label>';
                    html +='<textarea name="direcciones-coberturas" class="form-control direcciones-coberturas'+eventDe['calendar'][0].cl_id+'" rows="3"></textarea>';
                    html +='</div>';

                    html +='<div class="col-md-12"><h4><strong>Realizar reporte</strong></h4></div>';

                    html +='<div class="form-group col-md-12">';
                    html +='<label>Tipo de reporte</label>';
                    html +='<select name="tipo-reporte" class="form-control tipo-reporte'+eventDe['calendar'][0].cl_id+'">';
                    html +=eventDe['options'];
                    html +='</select>';
                    html +='</div>';

                    html +='<div class="form-group col-md-12">';
                    html +='<label>Reporte</label>';
                    html +='<textarea name="text-reporte" class="form-control text-reporte'+eventDe['calendar'][0].cl_id+'" rows="3"></textarea>';
                    html +='</div>';

                    if(eventDe['calendar'][0].r_id == 7){

                       html += '<input type="hidden" name="mi-calendario" value="1">';

                    }else{

                        html += '<input type="hidden" name="mi-calendario" value="0">';
                    }

                    html +='<div class="form-group col-md-12">';
                    html +='<button id="'+eventDe['calendar'][0].cl_id+'" class="btn green submit-reporte-calendario" name="submit-reporte-calendario" type="button">Reportar</button>';
                    html +='</div>';

                }else if(rol == 7){

                	html +='<div class="form-group col-md-12">';
                    html +='<label>Reporte</label>';
                    html +='<textarea name="text-reporte" class="form-control" rows="3"></textarea>';
                    html +='</div>';

                    html +='<div class="form-group col-md-12">';
                    html +='<button id="'+eventDe['calendar'][0].cl_id+'" class="btn green" name="submit-reporte-calendario" type="submit">Reportar</button>';
                    html +='</div>';

                }

                //html +=eventDe['calendar'][0].cs_tipo;
//console.log(eventDe['calendar'][0].cs);
                /*for (var i = 0; i < eventDe['calendar'][0].cs.length; i++) {
                    
                    eventDe['calendar'][0].cs[i];
                }*/
                //si el cliente es de tipo oficina
                if( eventDe['calendar'][0].c_type == 'office_event' ) {

                    $('.modal-title').html('Evento: '+eventDe['calendar'][0].c_title);

                    html ='<div class="row">';
                    html +='<form action="'+site_url+'/calendario/closeEvent" id="'+eventDe['calendar'][0].c_id+'" method="post">';
                    html +='<input type="hidden" id="custId" name="eventId" value="'+eventDe['calendar'][0].c_id+'">'
                    html +='<div class="form-body">';
                    html +='<div class="form-group col-md-12">';
                    html +='<label>Comentario</label>';
                    html +='<textarea name="text-reporte" class="form-control" rows="3">'+eventDe['calendar'][0].c_comentario+'</textarea>';
                    html +='</div>';
                    html +='<div class="form-group col-md-12">';
                    html +='<button id="'+eventDe['calendar'][0].c_id+'" class="btn green" name="close-event" type="submit">Cerrar</button>';
                    html +='</div>';
                }

                
                html +='</div>';
                html +='</form>';
                html +='</div>';

                $('.modal-body').html(html);
                $('#eventoslistModal').modal('show');
            
            }
        });

        
        $('body').on('change', '.peticion-cobertura', function(){

            if($(this).val() == 0){

                $('.direcciones-coberturas').hide();

            }else if($(this).val() == 1){

                $('.direcciones-coberturas').show();

            }

        });

        $('body').on('click', '.submit-reporte-calendario', function(){

            var id = $(this).attr('id');
            var tipoReporte = $('#eventoslistModal .tipo-reporte'+id).val();
            var petiCobertura = $('#eventoslistModal .peticion-cobertura'+id).val();
            var direCobertura = $('#eventoslistModal .direcciones-coberturas'+id).val();
            var textReporte = $('#eventoslistModal .text-reporte'+id).val();
            //es obligatorio que se reporte en todos los casos, así que comprobamos si textReporte es distinto
            //de vacío, en caso afirmativo, mostramos un mensaje al usuario.
            if( textReporte != "" ) {

                //comprobamos si tipo de reporte es 2 en su valor, si es el caso
                //comprobamos si ha pedido cobertura, si no la ha solicitado, indicamos
                //que esto es obligatorio para este caso
                if( tipoReporte == 2 ) {

                    if( petiCobertura == 0 || direCobertura =="" ) {
                        //mostramos un aviso al usuario
                        alert('Para reporta Factura recogida, es obligatorio realizar petición de cobertura.');

                    }else {
                        //si no se cumple realizamos submit
                        $( "#eventoslistModal form#"+id ).submit();
                    }

                }else{

                    //si no se cumple realizamos submit
                    $( "#eventoslistModal form#"+id ).submit();
                }

            }else{

                //mostramos un aviso al usuario
                alert('Reporte no puede ser vacío.');
            } 

        });

     },

     DeleteEvent: function(){

        $('body').on('click', '.delete-event', function(){

            var id = $(this).attr('id');
            
            var type = 'POST';
            var url = site_url+'/calendario/delete_event';
            var data = {'id':id};

            ActionAjax(type,url,data,null,null,false,false);

            //eliminamos el item de la tabla
            $('tbody tr#event-'+id).remove('tr#event-'+id);



        });

     },

     EditEvent: function(){

        $('body').on('click', '.edit-event', function(){

            var id = $(this).attr('id');
            
            var type = 'POST';
            var url = site_url+'/calendario/get_event_detail';
            var data = {'id':id};

            var event = ActionAjax(type,url,data,null,null,true,false);
            eventDe = JSON.parse(event);

            $('.modal-title').html('Evento: <a target="_blank" href="'+site_url+'/clientes/edit/'+eventDe['calendar'][0].cl_id+'">'+eventDe['calendar'][0].cl_nombre)+'</a>';

            var html = getEventDetails(eventDe);
            
            $('#eventoEditModal input[name="idEvent"]').val(eventDe['calendar'][0].c_id);
            $('.check-event').attr('key',eventDe['calendar'][0].c_id);

            html +='</div>';
            html +='</form>';
            html +='</div>';

            if(eventDe['calendar'][0].c_checkit)
            {
                $('.check-event').prop('checked', true);
            }

            $('.modal-body #content-event-details').html(html);

        });

        $('body').on('click', 'button[name="edit-submit"]', function(){

            var id = $('#form-edit form').attr('id');
            var date = $('#form-edit input[name="fEvent"]').val();
            var hour = $('#form-edit input[name="hEvent"]').val();
            var comment = $('#form-edit textarea[name="commentEvent"]').val();
            var user = $('#form-edit select[name="usuario"]').val();
            var _date = $('#table-calendar table').data('date');
            var _day = $('#table-calendar table').data('day');
            
            var type = 'POST';
            var url = site_url+'/calendario/edit_event';
            var data = {'id':id,'date':date,'hour':hour,'comment':comment,'user':user,'_date':_date,'_day':_day};
            ActionAjax(type,url,data,null,null,false,false);
            
            $('#eventoslistModal').modal('hide');
            addEventCalendar(_date);

        });

     },

     OnlyCheck: function(){

        $('body').on('click', '.only-check', function(){

            var user_list = "";

            $('.users').prop('checked', false);

            $('.users').each(function(){

                 user_list += $(this).val()+',';

            });

            user_list = user_list.substring(0, user_list.length-1);

            addEventCalendar(date = $('.calendar').attr('id'),user_list,1,1);

        });

     },

     ToolTip: function(){

     	$('body').on('mouseenter', '.tooltipBox', function(){

     		var id = $(this).attr('id');
     		$(".tooltipInfo").hide();
     		$("#tooltip"+id).show();

     	});

     	/*$('body').on('mouseleave', '.tooltipBox', function(){

     		var id = $(this).attr('id');
     		$("#tooltip"+id).hide();

     	});*/

     },

}

function AddClassDays(){

    $('.day').each(function(){

        $(this).attr('id',"day-"+$(this).text());

    });
}

function addEventCalendar(date,userlist = false,cd = 0, check = 0){

    //limpiamos el calendario
    $('.day p').remove('p');
    //obtenemos el día actual
    var today = new Date();
    //almacenamos el v. año, mes, día y hora+minutos
    var year = today.getFullYear();
    var month = today.getMonth();
    var day = today.getUTCDate();
    var minutes = (today.getMinutes()<10?'0':'') + today.getMinutes();
    var hour = parseFloat(today.getHours()+'.'+minutes);
    var cd = cd;

    var user_list = '';

    if( $('.users').is(':checked') || userlist ){

        $('.users').each(function(){

            if( $(this).is(':checked') ){

                user_list += $(this).val()+',';

            }

        });
        ;

        user_list = user_list.substring(0, user_list.length-1);

        if(userlist){user_list = userlist;}
        
        var type = 'POST';
        var url = site_url+'/calendario/get_events';
        var data = {'user_list':user_list,'date':date,'cd':cd,'check':check};

        var events = ActionAjax(type,url,data,null,null,true,false);
        
        events = JSON.parse(events);

        

        //si user_list es distinto de vacío
        if(user_list != ""){
            /*
                si usuario consultado es igual a 0, este es comercial: dibujamos su calendario de dicho comercial.
                si susario consultado es igual a 1, este es director comercial y como hibrido, hay que dibujar tanto
                el calendario de su equipo como el calendario propio. Nota, el calendario de su equipo hace referencia 
                al calendario de las zonas a revisar no al calendario de ventos completo.
            */
            if(cd == 0){

                $.each(events, function(key,value){

                    getEvents(value);
                 
                });

            }else if( cd == 1 ){


                $.each(events[0], function(key,value){

                    getEvents(value);
                 
                });

                $.each(events[1], function(key,value){

                    getEvents(value);
                 
                });

            }

            

        }

    }


}

function getEvents(value){

    var event='';

    if( value.type != "office_event" ) {


        event += '<div style="display:none;" id="tooltip'+value.id+'" class="tooltipInfo">';

        $.each(value.idcliente.cuentasSeguimiento, function(key,value2){

            if(value2.actual == true){

                event += '<strong style="color:red;">'+value2.tipo+'</strong><br/>';
            }
            
        });

        
        event += '<strong>'+value.idcliente.nombre+'</strong><br/>';
        //comprobamos si es objeto es undefined
        if (typeof(value.idcliente.idoperador) != "undefined") {

            event += '<strong>Operador:</strong> '+value.idcliente.idoperador.valor+'<br/>';
        }

        event += '<strong>Líneas Móvil:</strong> '+value.idcliente.lineasmovil+'<br/>';
        event += '<strong>Población:</strong> '+value.idcliente.poblacion+'<br/>';
        event += '</div>';
    }
                event += '<p';
                event += ' id="'+value.id+'"';
                event += ' data-day="'+value.day+'"';

                

                    //if(value.year == year && parseInt(value.month) - 1 == month && value.day == day && value.hour < hour){
                    if(rol == 1 || rol == 8){

                        if(value.estado == 0){

                            event += 'class="tooltipBox btn-event" style="background-color:'+value.idusuario.color+'">';

                        }else{

                            event += 'class="tooltipBox btn-event" style="background-color:'+value.idusuario.color+';text-decoration: line-through;">';

                        }
                    
                    }else{

                        if(value.estado == 0){

                            event += ' class="tooltipBox btn-event activo" style="background-color:'+value.idusuario.color+'">';


                        }else{

                            event += ' class="tooltipBox btn-event activo" style="background-color:'+value.idusuario.color+';text-decoration: line-through;">';
                        }

                    }


                //comprobamos el rol del usuario, ya que este btn de edición solo se dibuja si este es superadmin = 1
                if(rol == 1 || rol == 8){

                   event += '<span id="'+value.id+'" data-toggle="modal" data-target="#eventoEditModal" style="color: rgb(0, 0, 0); background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: right; position: relative; top: 10px; right: 6px; width: 21px; height: 21px;" class="badge badge-success edit-event"><i class="fa fa-pencil"></i></span>';
                   
                }

                //if(rol == 7 || rol == 1 || rol == 6 || rol == 8 || rol == 4){
                           
                    if(value.checkit){
                        
                        event += '<span style="color: rgb(0, 0, 0); background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: right; position: relative; top: 10px; right: 6px; width: 21px; height: 21px;" class="badge badge-success edit-event"><i class="fa fa-eye"></i></span>';

                    }else if( value.type === 'Volver a llamar' ) {

                        event += '<span style="color: rgb(0, 0, 0); background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: right; position: relative; top: 10px; right: 6px; width: 21px; height: 21px;" class="badge badge-success edit-event"><i class="fa fa-phone"></i></span>';

                    }


               // }

                if( value.type == "office_event" ) {

                    event += value.title;

                }else{

                    event += value.idcliente.nombre;
                }
                event += '<br/>';
                event += value.hour.replace('.', ':');
                event += '</p>';

                $('#day-'+value.day).append(event);

}

function getTableEvent(eventsL,date,day){

        var html = '';
        var _date ='';
        var _hour = '';

        html += '<table data-date="'+date+'" data-day="'+day+'" class="table table-hover table-light">';
        html += '<thead>';
        html += '<tr>';
        html += '<th>Fecha</th>';
        html += '<th>Hora</th>';
        html += '<th>Acciones</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';

        $.each(eventsL, function(key,value){

            _date = value.fecha.date.split(' ');
            _hour = _date[1].split('.');

            html += '<tr id="event-'+value.id+'">';
            html += '<td>'+_date[0]+'</td>';
            html += '<td>'+_hour[0]+'</td>';
            html += '<td>';
            html += '<a id="'+value.id+'" style="cursor: pointer;" class="btn yellow edit-event" title="Editar"><i class="icon-pencil"></i></a>';
            html += '<a id="'+value.id+'" style="cursor: pointer;" class="btn red delete-event" title="Eliminar"><i class="icon-trash"></i></a>';
            html += '</td>';
            html += '</tr>';
         
        });

        html += '</tbody>';
        html += '</table>';

        $('#table-calendar').html(html);

    }

    function getEventDetails(obj){

    	var html='';

    	html +='<div class="row">';
        html +='<form id="'+obj['calendar'][0].cl_id+'" method="post">';
        html +='<div class="form-body">';

        html +='<input type="hidden" name="id-calendario" value="'+obj['calendar'][0].c_id+'">';

        html +='<div class="form-group col-md-6">';
        html +='<label>Comercial</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].u_nombre+' '+obj['calendar'][0].u_apellidos+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-6">';
        html +='<label>Teleoperador/a</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].top_nombre+' '+obj['calendar'][0].top_apellidos+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-12">';
        html +='<label>Estado Seguimiento</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['cSeguimiento']+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-8">';
        html +='<label>Razón Social</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].cl_nombre+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-4">';
        html +='<label>CIF</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].cl_cif+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-6">';
        html +='<label>Fecha</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].c_day+'/'+obj['calendar'][0].c_month+'/'+obj['calendar'][0].c_year+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-6">';
        html +='<label>Hora</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].c_hour.replace(".", ":")+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-12">';
        html +='<label>Dirección</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].cl_direccion+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-8">';
        html +='<label>Población</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].cl_poblacion+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-4">';
        html +='<label>CP</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].cl_cp+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-8">';
        html +='<label>Contacto</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].cl_personacnt+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-4">';
        html +='<label>Telefono</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].cl_telefono+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-8">';
        html +='<label>Operador</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].op_valor+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-4">';
        html +='<label>Nº líneas</label>';
        html +='<div class="input-group col-md-12">';
        html +='<input disabled class="form-control" type="text" value="'+obj['calendar'][0].cl_lineasmovil+'" />';
        html +='</div>';
        html +='</div>';

        html +='<div class="form-group col-md-12">';
        html +='<label>Comentarios</label>';
        html +='<textarea disabled class="form-control" rows="3">'+obj['calendar'][0].cl_descripcion+'</textarea>';
        html +='</div>';

        return html;
    }

$(window).load(Calendar.Start);
$(window).load(Calendar.NextPrev);
$(window).load(Calendar.CheckboxUser);
$(window).load(Calendar.ShowEventsDetail);
$(window).load(Calendar.DeleteEvent);
$(window).load(Calendar.EditEvent);
$(window).load(Calendar.ToolTip);
$(window).load(Calendar.OnlyCheck);



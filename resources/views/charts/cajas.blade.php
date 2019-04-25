@extends('layouts.app')
@section('title', 'Reporte de Historial de cajas')
@section('color-style', 'bg-info')

@section('content')
<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}"/>

<style type="text/css">
    .fc-today{
        background: red;
        color: #fff;
    }
    .fc td{
        color: red;
        font-weight: 500;
    }
    .fc-title{
        color: #fff;
        font-weight: 700;
        text-align: left;
    }
    .fc-content, .fc-event{
        background: #FF6E56;
        border: 1px solid transparent;
        text-align: left;
    }

</style>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="container" id="calendar">
                </div>
 				
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>

<script type="text/javascript">
$(function() {
    $('#calendar').fullCalendar({
        header: {
	      left: 'prev,next today',
	      center: 'title',
	      right: 'month,agendaWeek,agendaDay,listWeek'
	    },
        defaultDate: '<?=date("Y-m-d")?>',
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: false, // allow "more" link when too many events
        events: [
        	<?php for ($i=0; $i < count($cajas) ; $i++){?>
	        		{
	        			id: '<?=$cajas[$i]->id ?>',
	        			title: 'Caja No. <?=$cajas[$i]->id?>',
	        			start: '<?=$cajas[$i]->apertura?>',
	        			end: '<?=$cajas[$i]->cierre?>',
	        			description: 'User: <?=$cajas[$i]->user_id ?> <?=$cajas[$i]->name ?>',
	        		}
	        		<?php if (count($cajas)-1 != $i){
			            echo ",";
			        } ?>
	        <?php } ?>
	        ,{
            title: 'Hoy',
            start: '<?=date("Y-m-d")?>',
            end: '2018-03-10',
            description: ''
        	}
        ],
        eventRender: function(event, element) { 
            element.find('.fc-title').append("<br/>" + event.description); 
        },
        monthNames: [ "Enero","Febrero","Marzo","Abril","Mayo","Junio",
            "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ],
        monthNamesShort: [ "ene","feb","mar","abr","may","jun",
            "jul","ago","sep","oct","nov","dic" ],
        dayNames: [ "domingo","lunes","martes","miércoles","jueves","viernes","sábado" ],
        dayNamesShort: [ "dom","lun","mar","mié","jue","vie","sáb" ],
        dayNamesMin: [ "D","L","M","X","J","V","S" ],
        weekHeader: "Sm",
        buttonText: {
            month: "Mes",
            week: "Semana",
            day: "Día",
            list: "Agenda"
        },

    });
});
</script>
@endsection

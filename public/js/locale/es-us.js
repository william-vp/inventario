//import 'moment/locale/es-us';
//import * as FullCalendar from 'fullcalendar';

/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
/* Traducido por Vester (xvester@gmail.com). */
$('#calendar').fullCalendar({
  closeText: "Cerrar",
  prevText: "&#x3C;Ant",
  nextText: "Sig&#x3E;",
  currentText: "Hoy",
  monthNames: [ "Enero","Febrero","Marzo","Abril","Mayo","Junio",
  "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ],
  monthNamesShort: [ "ene","feb","mar","abr","may","jun",
  "jul","ago","sep","oct","nov","dic" ],
  dayNames: [ "domingo","lunes","martes","miércoles","jueves","viernes","sábado" ],
  dayNamesShort: [ "dom","lun","mar","mié","jue","vie","sáb" ],
  dayNamesMin: [ "D","L","M","X","J","V","S" ],
  weekHeader: "Sm",
  dateFormat: "dd/mm/yy",
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: "" });

$('#calendar').fullCalendar({
  buttonText: {
    month: "Mes",
    week: "Semana",
    day: "Día",
    list: "Agenda"
  },
  allDayHtml: "Todo<br/>el día",
  eventLimitText: "más",
  noEventsMessage: "No hay eventos para mostrar"
});
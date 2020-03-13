// function de ajax global para el uso del mismo
var ajaxViews = function(url, method, type, data, success){
  $.ajax({
    url: url,
    method: method, 
    data : data,
    dataType: type,
    success: function(response){ 
      if(response != null && success != null){
        success(response);
      }              
    },
    error: function( jqXHR, textStatus, errorThrown){
      console.log("Error: " + errorThrown,"Hubo un error en la llamada:  " + url + " | " + textStatus)
    }
  });
};

var ajax_ = function(url, method, type, data, success){
  $.ajax({
    url: url,
    method: method, 
    data : data,
    dataType: type,
    beforeSend: function(xhr){
      Elem = document.getElementById('credencialesaccess')      
      xhr.setRequestHeader('Authorization', "Basic " + btoa(Elem.getAttribute('primero') + ":" + Elem.getAttribute('segundo'))); 
    },
    success: function(response){ 
      if(response != null && success != null){
        success(response);
      }              
    },
    error: function( jqXHR, textStatus, errorThrown){
      console.log("Error: " + errorThrown,"Hubo un error en la llamada:  " + url + " | " + textStatus)
    }
  });
};

var Alerts = function(Element, Type, Message) {
  let alert = ""
  switch(Type){
    case 'primary' :
      alert = '<div class="alert alert-primary alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-camera"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
    case 'info' :
      alert = '<div class="alert alert-info alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-layers"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
    case 'success' :
      alert = '<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
    case 'warning' :
      alert = '<div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-bell"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
     case 'danger' :
      alert = '<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-ban"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
  }
    document.getElementById(Element).innerHTML = alert
          
}

/**
 *  raphael-2.1.4.min.js
 * @param {*} element 
 */
var GlobalOpenModal = function(element){
    $("#" + element).modal("show");
    $('.modal-backdrop').remove()
}
/**
 * 
 * @param {*} element 
 */
var GlobalCloseModal = function(element){
     $("#" + element).modal("hide");
}
/**
 * 
 */
var GlobalInitialDatatable = function(element){
  var table = $('#' + element).DataTable({
      "language": { "url": "public/plugins/DataTables/locales/Spanish.json" },
      "dom": 'Bfrtip',
      "buttons": [
          'excel', 'pdf'
      ],
      "autoWidth": false,
      orderCellsTop: true,
      fixedHeader: true,
      "order": [[ 0, "desc" ]]
  });

  $('#'+element+' thead tr').clone(true).appendTo( '#'+element+' thead' );
  $('#'+element+' thead tr:eq(1) th').each( function (i) {
      
      if(i < $('#'+element+' thead tr:eq(1) th').toArray().length){
          var title = $(this).text();
          $(this).html( '<input type="text" class="form-control input-sm" placeholder="Buscar en '+title+'" />' );
   
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
      }
      
  } );
}

var GlobalInitialDatatableSimple = function(element){
    var table = $('#' + element).DataTable({
        "language": { "url": "../../public/plugins/DataTables/locales/Spanish.json" },
        "dom": 'Bfrtip',
        // "info":     false,
         buttons: [
            {
                extend:    'excelHtml5',
                titleAttr: 'Exportar Excel',
                className: 'mystylebutton'
            },
            {
                extend:    'pdfHtml5',
                titleAttr: 'Exportar PDF',
                className: 'mystylebutton'
            },
            {
                extend:    'print',
                titleAttr: 'Imprimir',
                className: 'mystylebutton'
            }
        ],
        "autoWidth": false,
        "searching": false,
        orderCellsTop: true,
        fixedHeader: true,
        // "order": [[ 0, "desc" ]]
    });

    return table
}


var GlobalInitialDatatableSimple1 = function(element, position){
    var table = $('#' + element).DataTable({
        "language": { "url": "../../public/plugins/DataTables/locales/Spanish.json" },
        "dom": 'Bfrtip',
        "info":     false,
         buttons: [
            {
                extend:    'excelHtml5',
                titleAttr: 'Exportar Excel',
                className: 'mystylebutton'
            },
            {
                extend:    'pdfHtml5',
                titleAttr: 'Exportar PDF',
                className: 'mystylebutton'
            },
            {
                extend:    'print',
                titleAttr: 'Imprimir',
                className: 'mystylebutton'
            }
        ],
        "autoWidth": false,
        "searching": false,
        orderCellsTop: true,
        fixedHeader: true,
        "order": [[ position, "desc" ]]
    });

    return table
}


var toastAlert = function(classs, title, message, position, icon){
  let configiziToast = {
    class: "iziToast-" + classs || "",
    title: title,
    message: message || "toast message",
    animateInside: !1,
    position: position,
    progressBar: !1,
    icon: icon,
    timeout: 3200,
    transitionIn: "fadeInLeft",
    transitionOut: "fadeOut",
    transitionInMobile: "fadeIn",
    transitionOutMobile: "fadeOut"
  };
  iziToast.show(configiziToast);


}

var CleanSpaces = function(str) {
  while (str.indexOf(" ") > -1) {
    str = str.replace(" ", "");
  }
  return str;
}

var getChecked = function(Elem){
  let value 
  $(Elem).each(function(index, el) {
    if ($(this).is(":checked")) {
      value = $(this).val()
    }
  });
  return value
}
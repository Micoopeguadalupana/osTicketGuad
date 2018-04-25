$(document).ready(function(){
  $(".table th").addClass("headerSortup");
  //datepicker control jquery ui y alfield es el valor que se manda a buscar en la bd.
  $("#fechaInicio").datepicker({dateFormat:"dd/mm/yy", altFormat:"yy-mm-dd", altField:"#fechaInicioAlt"});
  $("#fechaFin").datepicker({dateFormat:"dd/mm/yy", altFormat:"yy-mm-dd", altField:"#fechaFinAlt"});
  $( "#fechaInicio" ).datepicker( "setDate", new Date() );
  $( "#fechaFin" ).datepicker( "setDate", new Date() );
});

  //boton "buscar" segun parametros introducidos
  function buscar(){
    if ($("#bodyreports tr").length >=1) {
      $("#bodyreports").empty();
    }
    var fechaInicio = $("#fechaInicioAlt").datepicker().val();
    var fechaFin = $("#fechaFinAlt").datepicker().val();
    var departamento = $("#selectdep")[0].value;
    $.ajax({
      url: 'generarTabla.php',
      method: 'POST',
      data: {date1: fechaInicio, date2:fechaFin, depto: departamento},
      cache:false,
      success:function(html){
        $("#bodyreports").append(html)
      },
      error: function(err) {
        alert(err);
      }
    }).done(function(){
      habilitarDesabilitarReporte();
    });
  }

function habilitarDesabilitarReporte (){
  if ($("#bodyreports").children("tr").length >=1) {
    $("#bExport").removeAttr('disabled');
  }else{
    $("#bExport").attr("disabled",true);
  }

}
  //js para el sorting en la tabla.
  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("datatable");
    switching = true;
  // Set the sorting direction to ascending:
    dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
    while (switching) {
  // Start by saying: no switching is done:
      switching = false;
      rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /* Check if the two rows should switch place,
        based on the direction, asc or desc: */
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
          }
        } else if (dir == "desc") {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch= true;
            break;
            }
          }
        }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Each time a switch is done, increase this count by 1:
        switchcount ++;
      } else {
        /* If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again. */
        if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
        }
      }
    }
  }// fin sortTable

  /*function fnExcelReport()
  {
      var tab_text="<table border=''><tr bgcolor=''>";
      var textRange; var j=0;
      tab = document.getElementById('datatable'); // id of table

      for(j = 0 ; j < tab.rows.length ; j++)
      {
          tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
          //tab_text=tab_text+"</tr>";
      }

      tab_text=tab_text+"</table>";
      tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
      tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

      var ua = window.navigator.userAgent;
      var msie = ua.indexOf("MSIE ");

      if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
      {
          txtArea1.document.open("txt/html","replace");
          txtArea1.document.write(tab_text);
          txtArea1.document.close();
          txtArea1.focus();
          sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
      }
      else                 //other browser not tested on IE 11
          sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

      return (sa);
  }*/
  function generarExcel(){
    myExcel= new ExcelGen({
      "src_id":"datatable",
      "show_header": true
    })
    myExcel.generate();
  }


//document ready end

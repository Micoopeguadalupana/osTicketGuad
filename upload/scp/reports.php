<?php
require('staff.inc.php');
$nav->setTabActive('dashboard');
require(STAFFINC_DIR.'header.inc.php');
require('conexiondb.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN""http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/reporteTickets.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h2>Reporte de Seguimiento de tickets</h2>
      <div class="row">
        <div class="col-sm-3 align form-control">
          <label for="fechaInicio">Fecha Inicio:</label> <input type="text" id="fechaInicio" name="fechaInicio">
          <input type="hidden" id="fechaInicioAlt" value="" name='Ftest'>
        </div>
        <div class="col-sm-3 align form-control">
          <label for="fechaFin">Fecha Fin:</label> <input type = "text" id="fechaFin">
          <input type="hidden" id="fechaFinAlt" value="">
        </div>
        <div class="col-sm-3 align">
          <label for="selectdep">Depártamentó:</label>
          <!-- aqui populo el select según la data que exista en la bd -->
          <select class="form-control" name="" id="selectdep">
            <?php
              $deptData = "select DISTINCT rept.dept_id, dep.name from reporte_ticket AS rept join ost_department AS  dep on rept.dept_id=dep.id";
              $result = $conn->query($deptData);
              if ($result-> num_rows>0) {
                while ($row= $result->fetch_assoc()) {
                 echo "<option value='".$row['dept_id']."'>".utf8_encode($row['name'])."</option>";
                }
              }else {
                echo "<option value=''>'No data'</option>";
              }
              $conn-> close();
            ?>
          </select>
        </div>
        <div id="btnBuscar" class="col-sm-3 align">
          <input class="btn" type="submit" name="btnBuscar" value="Buscar" onclick="buscar();">
        </div>
      </div>
      <div class="row">
        <table class="table table-hover table-responsive" id="datatable">
          <thead>
            <tr class="table-primary">
              <th scope="col" style="width:10%; white-space:normal;" onclick="sortTable(0);" class=""><p><b>No. de ticket</b></p></th> <!--<i class="material-icons md-18">keyboard_arrow_up</i><i class="material-icons">keyboard_arrow_down</i>-->
              <th scope="col" style="width:15%" onclick ="sortTable(1)" ><p><b>Asignado a</b></p></th>
              <th scope="col" style="width:15%" onclick="sortTable(2)"><p><b>Creado Por</b></p></th>
              <th scope="col" style="white-space:normal; width: 8%;" onclick="sortTable(3)"><p><b>Obtuvo Respuesta</b></p> <!--<button type="button" class="btn btn-default btn-sm"><i class="material-icons">import_export</i></button>--></th>
              <th scope="col" style="white-space:normal; width: 8%;" onclick="sortTable(4)"><p><b>Esta atrasado</b></p></th>
              <th scope="col" style="white-space:normal; width: 12.5%;" onclick="sortTable(5)"><p><b>Fecha apertura</b></p></th>
              <th scope="col" style="width:12.5%" onclick="sortTable(6)"><p><b>Fecha Reapertura</b></p></th>
              <th scope="col" style="width:12.5%" onclick="sortTable(7)"><p><b>Fecha Cierre</b></p></th>
            </tr>
          </thead>
          <tbody id="bodyreports">
          </tbody>
        </table>
      </div>
      <div class="row">
        <input class="btn" id="bExport" type="button" name="btnExportar" value= "Exportar a .xlsx" onclick="generarExcel();" disabled>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./js/jszip.min.js"></script>
    <script type="text/javascript" src="./js/FileSaver.min.js"></script>
    <script type="text/javascript" src="./js/excel-gen.js"></script>
    <script type="text/javascript" src="./js/reporteTickets.js"></script>

    <!-- Plugin exportar a excel .js-->
  </body>
</html>

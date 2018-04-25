<?php
  require('conexiondb.php');
  //header("Refresh:0");
  $fecha1 = $_POST['date1'];
  $fecha2 = $_POST['date2'];
  $depto = $_POST['depto'];
  $tableData = " select number, agente, usuario, (CASE WHEN isanswered <> 0 THEN 'Si' ELSE 'No' END) AS Respuesta, (CASE WHEN isoverdue <> 0 THEN 'Si' ELSE 'No' END) As Atrasado, cast(created AS date) AS created, cast(closed AS date) AS closed, cast(reopened AS date) AS reopened FROM reporte_ticket WHERE cast(created AS date) BETWEEN cast('$fecha1' AS date) AND cast('$fecha2' as date) AND dept_id= '$depto'";
  //echo $tableData;
  $result = $conn->query($tableData);
  if ($result-> num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row['number']."</td><td>".utf8_encode($row['Agente'])."</td><td>".$row['Usuario']."</td><td>".$row['Respuesta']
      ."</td><td>".$row['Atrasado']."</td><td>".$row['created']."</td><td>".$row['reopened']."</td><td>".$row['closed']
      ."</td></tr>";
    }
  }else {
    echo "<script>alert('No se han encontrado datos')</script>";
  }
$conn->close();
 ?>

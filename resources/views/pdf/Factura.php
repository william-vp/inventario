<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ver Factura <?= $factura->id ?> </title>
<style>
*{
  border-spacing: -5px;
}
 
body{
  padding: 0px;
  margin: 0px;
  font-family: Helvetica;
  font-size: 8px;
}

 .col-md-12 {
    width: 100%;
    padding: 0px;
    margin: 0px;
} 

.box {
    position: relative;
    border-radius: 0px;
    background: #ffffff;
    border-top: 1px solid #d2d6de;
    margin-bottom: 10px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    background-color: #ECF0F5;
}

.box-header {
    color: #444;
    display: block;
    padding: 5px;
    position: relative;
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}


.box-header .box-title {
    display: inline-block;
    font-size: 15px;
    margin: 0;
    line-height: 1;
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;

}


.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}


.table-bordered {
    border: 1px solid #f4f4f4;
}


 .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #f4f4f4;
}


.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
}

.bg-red {
    background-color: #dd4b39 !important;
}

#tablaDetalles tr th{
  margin-right: 10px;
}
#tablaDetalles tr td{
    margin-left: 5px;
    margin-right: 5px;
}

</style>
	  
</head>
<body>

<div style="margin-top: -30px; margin-left: -30px; margin-right: -35px; margin-bottom: -50px;">   
    <table border="0"  style="width: 100%;">
      <tr>
        <td>
          <img src="images/logo.png" width="40">
        </td>
        <td align="left"><strong>NOMBRE EMPRESA</strong><br>
            slogan empresa
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">Nit. 00000000000</td>
      </tr>
      <tr align="center">
        <td colspan="2">Direccion empresa</td>
      </tr>
      <tr align="center">
        <td colspan="2">Teléfono empresa</td>
      </tr>
    </table>
    <br>

    <?php
      $date= explode(' ',$factura->fecha);
      $fecha= $date[0];
      $hora= $date[1];
    ?>
  <table style="width: 100%;">
    <tr>
      <td><strong>FACTURA No.: </strong></td>
      <td><?=$factura->id?></td>
    </tr>
    <tr>
      <td><strong>FECHA: </strong></td>
      <td><?=$fecha?></td>
    </tr>
    <tr>
      <td><strong>HORA: </strong></td>
      <td><?=$hora?></td>
    </tr>
    <tr>
      <td><strong>CLIENTE: </strong></td>
      <td><?=$factura->cliente_id?></td>
    </tr>
    <tr>
      <td><strong>NOMBRE: </strong></td>
      <td><?=$factura->nombreCliente?></td>
    </tr>
    <tr>
      <td><strong>CAJERO: </strong></td>
      <td><?=$usuario->name?></td>
    </tr>
  </table>
   
  <br>
   <table id="tablaDetalles">
     <tr align="center">
       <th width="20">CANT. </th>
       <th align="left"> DETALLE </th>
       <!--<th> IVA</th>-->
       <th> VR. UNIT. </th>
       <th> VR. TOTAL</th>
     </tr>
     <?php
     foreach ($productos as $producto ) {
      ?>
        <tr>
          <td align="center"><?=$producto->cantidad?></td>
          <td align="left" style="width: 100px; height: auto; overflow: auto">
              <?=mb_strtoupper($producto->nombre, 'UTF-8')?>
          </td>
          <!--<td align="center"><?=$producto->impuesto?></td>-->
          <td align="center"><?=number_format($producto->valor_unitario,'1',',','.')?></td>
          <td align="right"><?=number_format($producto->valor_total,'1',',','.')?></td>
        </tr>
      <?php
     }
     ?>
        <tr>
          <td colspan="2"></td>
          <th colspan="2">SUBTOTAL</th>
          <td align="right"><?=number_format($factura->subtotal,'1',',','.')?></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <th colspan="2">IVA</th>
          <td align="right"><?=number_format($factura->iva,'1',',','.')?></td>
        </tr>

        <?php
        if ($factura->descuento > 0){
          ?>
             <tr>
              <td colspan="2"></td>
              <th colspan="2">DESCUENTO (<?=$factura->descuento?>%) </th>
              <?php $valDescuento= $factura->subtotal * ($factura->descuento / 100); ?>
              <td align="right"><?=number_format($valDescuento,'1',',','.')?></td>
            </tr>
          <?php
        }
        ?>
        <tr>
          <td colspan="2"></td>
          <th colspan="2">TOTAL</th>
          <td align="right"><?=number_format($factura->total,'1',',','.')?></td>
        </tr>
       
   </table>

   <p style="width: 235px; overflow: hidden;"><strong>OBSERVACIONES: </strong><br>
     <?=$factura->observacion?>
   </p>
  
   <div align="center"><strong>GRACIAS POR SU COMPRA</strong></div>

</div>


	
</body>
</html>



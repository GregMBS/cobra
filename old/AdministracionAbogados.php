<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head
    <title>Página sin título</title>
    <style type="text/css">
        .style1
        {
        }
        .style4
        {
            width: 250px;
            height: 105px;
        }
        .style8
        {
            height: 171px;
            width: 1px;
        }
        .style11
        {
            width: 107px;
        }
        .style12
        {
            width: 376px;
        }
    </style>
		<script type="text/javascript" language="javascript" src="bower_components/datatables/media/js/jquery.js"></script> 
		<script type="text/javascript" language="javascript" src="bower_components/datatables/media/js/jquery.js"></script> 
		<script type="text/javascript" language="javascript" src="bower_components/datatables/media/js/jquery.dataTables.js"></script> 
		<script type="text/javascript" charset="utf-8"> 
			$(document).ready(function() {
				$('#AbogadoDetailView').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "judicial-abogados.php"
				} );
				$('#municipiosGridView').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "judicial-municipio.php"
				} );
			} );
		</script> 
</head>
<body style="background-color: #EFF3FB">
    <div>
        <table style="width:58%; border:1px; background-color:White" cellpadding="0" cellspacing="0">
            <tr style="background-color: #EFF3FB">
                <td class="style12">
                    <span style="border-style: none; color:white; font-size:medium; font-weight:bold; background-color:#507CD1">
                    &nbsp;&nbsp;ADMINISTRAR ABOGADOS&nbsp;&nbsp;</span></td>
                    <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="style4" valign="top">
<table id="AbogadoDetailView">
	<thead> 
		<tr> 
			<th>id</th> 
			<th>nombre</th> 
			<th>email</th> 
			<th>telefono</th> 
			<th>nextel</th> 
			<th>celular</th> 
		</tr> 
	</thead> 
	<tbody> 
		<tr> 
			<td colspan="5" class="dataTables_empty">Loading data from server</td> 
		</tr> 
	</tbody> 
</table>
                </td>
                <td valign="top" class="style8">
<table id="municipiosGridView">
	<thead> 
		<tr> 
			<th>zona</th> 
			<th>municipio</th> 
		</tr> 
	</thead> 
	<tbody> 
		<tr> 
			<td colspan="5" class="dataTables_empty">Loading data from server</td> 
		</tr> 
	</tbody> 
</table>
                </td>
            </tr>
</table>
</body>
</html>

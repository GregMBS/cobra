<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Cuentas Migo</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
    </head>
    <body>
        <table id="Cuentas" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>CUENTA</th>
                    <th>NOMBRE</th>
                    <th>CLIENTE</th>
                    <th>SEGMENTO</th>
                    <th>SALDO TOTAL</th>
                    <th>SALDO DESCUENTO</th>
                    <th>STATUS</th>
                    <th>ULT. GESTION</th>
                </tr>
            </thead>
        </table>
        <script>
            $(document).ready(function () {
                $('#Cuentas').dataTable({
                    "bPaginate": false,
                    "oLanguage": {
                        "sUrl": "espanol.txt"
                    },
                    serverSide: true,
                    ordering: false,
                    searching: false,
                    ajax: function ( data, callback, settings ) {
                        var out = [];

                        for ( var i=data.start, ien=data.start+data.length ; i<ien ; i++ ) {
                            out.push( [ i+'-1', i+'-2', i+'-3', i+'-4', i+'-5' ] );
                        }

                        setTimeout( function () {
                            callback( {
                                draw: data.draw,
                                data: out,
                                recordsTotal: 5000000,
                                recordsFiltered: 5000000
                            } );
                        }, 50 );
                    },
                    scrollY: 200,
                    scroller: {
                        loadingIndicator: true
                    },
                });
            });
        </script>
    </body>
</html>

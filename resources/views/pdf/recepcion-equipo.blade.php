<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Recepci&oacute;n de equipo</title>
    <style>
        body {
            font-family: DejaVu Sans, serif;
            font-size: 12px;
        }
        img {
            width: 85px;
        }
        table{
            width: 100%;
        }
        table .txt-center {
            text-align: center;
        }
        .header {
            margin-top: 10px;
        }
        .header, .products {
            border-spacing: 0;
            border-collapse: collapse;
        }
        .header td {
            border: 1px solid #cdcdcd;
            padding: 5px 5px 5px 10px;
        }
        .products thead tr {
            background-color: #8fc4e9;
        }
        .products {
            margin-top: 20px;
        }
        .products td, .products th {
            border: 1px solid #555;
            padding: 5px 5px 5px 10px;
            font-size: 12px;
            text-align: center;
        }
        .info .conditions {
            font-weight: bold;
        }
        .info .expand {
            border: 1px solid #989898;
            padding: 10px 5px;
        }
        .info .att {
            padding-top: 15px;
            text-align: center;
            font-weight: bold;
        }

        span strong {
            color: #8fc4e9;
        }
        li{
            font-size:10px
        }

        footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;


                /** Extra personal styles **/
                background-color: #ffffff;
                color: rgb(0, 0, 0);
                font-size: 10px;


            }
    </style>
</head>
<body style="width: 100%">
<table>
    <tbody>
    <tr><td colspan="3" style="font-weight: bold; padding: 3px 0; font-size: 16px" class="txt-center">RECEPCION DE EQUIPO</td></tr>
    </tbody>
</table>
<table class="header">
    <tbody>
    <tr>
        <td style="padding-top: 10px ">
            <span><strong>Cliente:</strong></span><br>
            <span>{{$manto->cliente->nombre}} {{$manto->cliente->apaterno}} {{$manto->cliente->amaterno}}</span><br>
            <span><strong>Dirección:</strong></span><br>
            <span>{{$manto->cliente->direccion}} </span><br>
            <span><strong>Correo Electrónico:</strong></span><br>
            <span>{{$manto->cliente->email}}</span><br>
            <span><strong>Teléfonos:</strong></span><br>
            <span>{{$manto->cliente->celular}} / {{$manto->cliente->telefono}}</span>
        </td>
        <td style="padding-top: 10px">
            <span><strong>Folio :</strong></span><br>
            <span>S-{{$manto->id}}</span><br>
            <span><strong>Estatus:</strong></span><br>
            <span>{{$manto->estatus}}</span><br>
            <span><strong>Fecha:</strong></span><br>
            <span>{{$manto->fecha_alta}}</span><br>
            <span><strong>Tecnico:</strong></span><br>
            <span>{{$manto->user->name}}</span>
        </td>
    </tr>
    </tbody>
</table>

<div style="width: 100%">
    <table class="header">
        <tbody>
        <tr>
            <td style="padding-top: 10px">
                <span><strong>Numero de serie:</strong></span><br>
                <span>{{$manto->serie}} </span><br>

                <span><strong>Tipo:</strong></span><br>
                <span>{{$manto->tipo}} </span>
            </td>
            <td style="padding-top: 10px">
                <span><strong>Marca:</strong></span><br>
                <span>{{$manto->marca}} </span><br>
                <span><strong>Modelo:</strong></span><br>
                <span>{{$manto->modelo}}</span><br>
            </td>

        </tr>
        <tr>
            <td colspan="2" style="padding-top: 10px" class="expand">
                {!!$manto->accesorios!!}
            </td>


        </tr>

        </tbody>
    </table>

    <table style="margin-bottom: 15px;" class="info">
        <tbody>
        <tr><td class="conditions">Falla:</td></tr>
        <tr>
            <td class="expand">
              {!!$manto->falla!!}
            </td>
        </tr>
        </tbody>
    </table>
    <table style="margin-bottom: 15px;" class="info">
        <tbody>
        <tr><td class="conditions">Observaciones adicionales:</td></tr>
        <tr>
            <td class="expand">
              {!!$manto->observaciones!!}
            </td>
        </tr>
        </tbody>
    </table>
    Condiciones:
    <ul>
        <li >Total de pago el 50% de adelanto al iniciar lo strabajos y al finalizar el otro 50%</li>
        <li>Pasando 30 dias Ciber Mania no se ara responsable por el abandono de su equipo</li>
        <li>Pasando 30 dias su equipo debera pagar $10 de bodegaadicional por cada dia</li>
        <li>Por favor, cualquier problema o molestioa su comentarios al 57763385 o info@gmail.com</li>
        <li>En caso de que Ciber Mania no realice la reparacion el costo de revision sera de $50 pesos</li>
        </ul>

    <footer>
        <table >
            <tbody>

            <tr>
                <td align="center">
                    <br>
                    <br>
                    ___________________________<br>
                    Firma del cliente<br>
                    {{$manto->cliente->nombre}} {{$manto->cliente->apaterno}} {{$manto->cliente->amaterno}}
                </td>
                <td align="center">
                    <br>
                    <br>
                    ___________________________<br>
                    Firma del tecnico<br>
                    {{$manto->user->name}}
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        <table>
            <tbody>
            <tr>
                <td style="text-align: center; font-size: 10px;">V1.1</td>
                <td style="text-align: center; font-size: 10px;">Fecha impresi&oacute;n: {{date('Y-m-d')}}</td>
                <td style="text-align: center; font-size: 10px;">Copyright &copy; <?php echo date("Y");?> SC Redes </td>
            </tr>
            </tbody>
        </table>

    </footer>
</div>
</body>
</html>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cotizaci&oacute;n</title>

    <style>

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 10px;

        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 12px;
        line-height: 16px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }


    </style>
</head>

<body>
    <span class="pagenum"></span>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('/images/logo.png') }}" style="width:150px; max-width:150px;">
                            </td>
                            <td align="right">
                                Cotizacion: <b>C-{{$cotizacion->id}}</b><br>
                                Fecha: <b>{{ \Carbon\Carbon::parse($cotizacion->fecha)->format('d/m/Y') }}</b><br>
                                Vencimiento: <b>{{ \Carbon\Carbon::parse($cotizacion->fecha)->add(5, 'day')->format('d/m/Y') }}</b><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">

                     <table>
                        <tr>
                                                    <td>

                                <b>{{ $cotizacion->cliente->nombre }} {{ $cotizacion->cliente->apaterno }} {{ $cotizacion->cliente->amaterno }}</b><br>
                                {{ $cotizacion->cliente->email }}

                            </td>
                            <td align="right">
                                SC REDES SAS de CV.<br>
                                Ecatepec de Morelos, Estado de M&eacute;xico
                            </td>


                        </tr>
                    </table>
                </td>
            </tr>








        </table>
        <p> En atención a su solicitud, nos permitios cotizar los siguientes articulos:</p>
    <table  style="width: 100%;  background: #ffffff; font-size: 10px;">
        <colgroup>
            <col style="width: 12%; text-align: left">
            <col style="width: 52%; text-align: left">
            <col style="width: 13%; text-align: center">
            <col style="width: 10%; text-align: center">
            <col style="width: 13%; text-align: center">
        </colgroup>
        <thead>
            <tr style="background: #E7E7E7;">
                <th></th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>

                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($cotizacion->detalleCotizacion as $item)
      <tr>

                <td style="text-align:center"><img width="25" height="25" src="{{$item->url_imagen}}" alt="imagen"></td>
                <td style="text-align:left">{{$item->descripcion}}</td>
                <td style="text-align:center">{{$item->cantidad }}</td>
                <td style="text-align:right">${{number_format($item->precio +($item->precio  * $item->utilidad / 100), 2)}}</td>

                <td style="text-align:right">${{number_format(($item->precio +($item->precio  * $item->utilidad / 100))  * $item->cantidad , 2)}}</td>

            </tr>
             @endforeach

            <tr style="background: #ffffff;">
                <th colspan="4" style="border-top: solid 0px black; text-align: right;">Subtotal : </th>
                <th style="border-top: solid 0px black; text-align:right">$ {{number_format($cotizacion->subtotal, 2)}}</th>

            </tr>
             <tr style="background: #ffffff;">
                <th colspan="4" style="border-top: solid 0px black; text-align: right;">IVA :</th>
               <th style="border-top: solid 0px black; text-align:right">$ {{number_format($cotizacion->iva, 2)}}</th>

            </tr>
            <tr style="background: #E7E7E7;">
                <th colspan="4" style="border-top: solid 0px ; text-align: right; ">Total : </th>
               <th style="border-top: solid 0px black; text-align:right">$  {{number_format($cotizacion->total, 2)}} </th>

            </tr>
        </tbody>
    </table>
    <p>
    Este documento y su anexo son confidenciales y utilizables solo por el cliente solicitante y la empresa <a href="http://scredes.com.mx/">SC REDES SAS de CV</a><br>
    @if($cotizacion->terminos)<b>* {{$cotizacion->terminos}}</b><br>@endif
<b>* Precios sujetos a cambio sin previo aviso. </b><br>
<b>* Observaciones comerciales: </b><br>

Para pedidos definidos con entrega inmediata, se efectuaran 24 A 48 hrs, despues de levantado el pedido con orden de compra.<br>
Las garantias son las que el fabricante provee para cada producto y se aplicaran directamente del fabricante al cliente.<br>
</p>


        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 12px;">
            <tr>
                <td style="width:50%;"></td>
                <td style="width:100%;">
                 {{-- <p>
        Si tienes alguna duda y/o comentario comunicate:<br>
        </p> --}}
                    {{-- <b>{{$user->emp_nombre}} {{$user->emp_ap_pat}} {{$user->emp_ap_mat}}</b><br>
                    Telefono : {{$user->emp_telefono}}<br>
                    whatsapp : {{$user->emp_whatsapp}}<br>
                    Correo : {{$user->email}}<br> --}}
                </td>
            </tr>
        </table>
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 12px;">
            <tr>
                <td style="width:50%;"></td>
                <td style="width:100%;">
                 <p>
                     Para realizar tu pago:
                </p>
                    Banco: <b>SANTANDER</b><br>
                    CLABE: <b>014180655069746459</b><br>
                    Número de cuenta: <b>65-50697464-5</b><br>
                    Razón social: <b>SCREDES SAS DE CV</b><br>
                    Despues de realizar tu deposito<br>
                    Favor de notificar al siguiente <br>
                    Correo:<b>contacto@scredes.com.mx</b><br>


                    {{-- Correo:<b>erika.correa@scredes.com.mx</b><br>
                    Telefono: <b>87881878</b><br>
                    whatsapp :<b>5550418113</b><br> --}}
                </td>
            </tr>
        </table>

    </div>

</body>
</html>

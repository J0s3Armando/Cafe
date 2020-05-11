<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body{
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }
        p{
            line-height:5px;
        }
        h5{
            text-align: center;
            font-size: 1.2em;
        }
    
        .bold{
            font-weight: bold;
        }
        
        .header{
            width: 100%;
        }
        .header img{
            width: 12em;
        }
        
        table
        {
            width: 100%;
            border-collapse: collapse;
        }
        th,td
        {
            border: 1px solid rgba(0,0,0,.1);
            text-align: center;
            padding: 5px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        .products-datail{
            width: 100%;
            text-align: center;
            margin: 20px 0px;
        }
            
    </style>
</head>
<body>
    <section class="container-pdf">
        <section class="header">
            <section class="logo">
                <img src="img/logo/thumbnail_café mukulum-01.png" >
            </section>
        </section>
        <section>
            <h5>Datos para el envío</h5>
            <table>
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>De</th>
                        <th>A</th>
                        <th>Contacto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>
                                N° de pedido: {{$order->id}}
                            </p>
                            Fecha: {{$order->created_at->format('d/m/Y h:i A')}}
                        </td>
                        <td>
                           {{$order->User->name}} {{$order->User->last_name}}
                        </td>
                        <td>
                            {{$order->User->address}},{{$order->User->State->state}},CP: {{$order->User->cp}}
                        </td>
                        <td>
                            {{$order->User->email}}, {{$order->User->phone}} 
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="products">
            <h5>Detalles del pedido</h5>
            <table>
                <thead>
                    <tr class="text-center">
                        <th>TIPO</th>
                        <th>UNIDAD</th>
                        <th >PIEZAS</th>
                        <th>PRECIO</th>
                        <th>SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="text-center">
                            <td class="align-middle">
                                @if ($product->categories->id_SubCategory != null)
                                    {{$product->categories->Subcategory->description}}
                                @else
                                    {{$product->categories}}
                                @endif
                            </td>
                            <td class="align-middle">{{$product->Unit->description}}</td>
                            <td class="align-middle">{{$product->pivot->quantity}}</td>
                            <td class="align-middle">$ {{number_format($product->pivot->price_sold,2)}}</td>
                            <td class="align-middle">$ {{number_format($product->pivot->total,2)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section class="products-datail">
            <h4> Sub-Total: $ {{number_format($order->subTotal,2)}} - 
                 Costo de envío: $ {{number_format($order->send,2)}}
            </h4>
            <hr>
            <h4> Total a pagar: $ {{number_format($order->total,2)}} </h4>
            <hr>
        </section>
    </section>
</body>
</html>
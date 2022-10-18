<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
</head>
<body>
<div id="invoice">
    {{-- pdf and print button start--}}
<div class="toolbar hidden-print">
    <div class="text-right">
        <button id="printInvoice" class="btn btn-info">
         <i class="fa fa-print"></i>
         Print
        </button>
        <button  class="btn btn-info">
         <i class="fa fa-file-pdf-o"></i>
        Export As Pdf
        </button>
    </div>
    <hr>
</div>
 {{-- pdf and print button end--}}

 <div class="invoice overflow-auto">
    <div style="min-width: 600px">
        {{-- header start --}}
        <header>
            <div class="row">
                <div class="col">
                    <a href="#" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="">
                    </a>
                </div>

                <div class="col company details">
                    <h3 class="name">
                        <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">{{ env('APP_NAME') }}</a>
                    </h3>
                    <div class="">Ecommerce Store Address</div>
                    <div class="">Ecommerce Store Mobile Number</div>
                    <div class="">ecom@gmail.com</div>
                </div>
            </div>
        </header>
{{-- header end  --}}

{{-- main section start --}}
<main>
    @foreach ($order_details as $order)
    <div class="row contract">
        <div class="col invoice-to">
            <div class="text-gray-light">
                Invoice To:
            </div>
            <h2 class="to">{{$order->billing->name ?? 'None' }}</h2>
            <div class="address"><i class="fa fa-home"></i>{{ $order->billing->address ?? 'None'}}</div>
            <div class="phone"><i class="fa fa-phone"></i>{{ $order->billing->phone_number ?? 'None'}}</div>
            <div class="email"><a href="mailto:miftah@gmail.com"><i class="fa fa-phone"></i></a>{{ $order->billing->email ?? 'None'}}</div>
        </div>
        <div class="col invoice-details">
            <h1 class="invoice-id">Invoice</h1>
            <div class="date">Date Of Invoice: {{ $order->created_at->format('D/m/Y') }}</div>
            <div class="date">Due Date Of Invoice: {{ $order->created_at->format('D/m/Y') }}</div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-left">Description</th>
                <th class="text-left">Quantity</th>
                <th class="text-left">Unit Price</th>
                <th class="text-left">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $item)
            <tr>
                <td class="no">{{ $loop->index+1 }}</td>
                <td class="text-left"><h3>{{$item->product->name  }}</h3></td>
                <td class="qty"><h3>{{ $item->product_qty }}</h3></td>
                <td class="unit_price"><h3>৳{{ $order->product_price }}</h3></td>
                <td class="total"><h3>৳{{$item->product_qty * $order->product_price }}</h3></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">Discount({{ $order->coupn_name }})</td>
                <td >-৳{{ $order->discount_amount }}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">Subtotal({{$order->total}})</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">Grand Total({{ $order->total}})</td>
            </tr>
        </tfoot>
    </table>
    @endforeach
    <div class="thanks">Thank you!</div>
</main>
<footer>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem possimus ipsum accusamus libero accusantium sint culpa molestias aliquid consequuntur iusto quie
</footer>
    </div>

 </div>

</div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $('#printInvoice').click(function(){
               Popup($('.invoice')[0].outerHTML);
               function Popup(data)
               {
                   window.print();
                   return true;
               }
           });
   </script>
</body>
</html>

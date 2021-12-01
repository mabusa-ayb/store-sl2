<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>The Embroidery Shop - Invoice</title>

    <style>
        h1 {
            background: #000;
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        .notes{
            text-align: center;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 5px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: sans-serif;
            color: #555;
            min-height: 842px;
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
            text-align: left;
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
<div class="invoice-box">
    <h1>Invoice</h1>
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="3">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{ asset ('images/logo/tes-logo.png') }}" style="width:50%; max-width:300px;">
                        </td>

                        <td style="text-align: right;">
                            <b>Invoice #{{ $sale->invoiceNumber }}</b><br>
                            <b>Order ID:</b> {{ $sale->id }}<br>
                            <?php
                            $date = $sale->date;
                            $date = strtotime($date);
                            $date = strtotime("+7 day", $date);
                            $date = date('M d, Y', $date);
                            ?>
                            <b>Payment Due:</b> {{ $date }}<br>
                            <br>
                            <small>Date: {{ $sale->date }}</small>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            <small>
                                <strong>SL2</strong><br>
                                Phone: +27 65 837 8231
                            </small>

                        </td>

                        <td style="text-align: right;">
                            <small>
                                <strong>{{ ucwords($buyer->fname).' '.ucwords($buyer->sname) }}</strong><br>
                                {{ $buyer->address1.', '.$buyer->address2 }}<br>
                                {{ $buyer->city.', '.strtoupper($buyer->country) }}<br>
                                {{ $buyer->email }}<br>
                                {{ $buyer->phoneNumber }}
                            </small>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Product Information -->
        <tr class="heading">

            <td>
                Qty
            </td>

            <td>
                Item
            </td>

            <td>
                Price
            </td>
        </tr>
        @if($currentTransaction != NULL)
            @foreach($currentTransaction as $tran)
                <tr class="item">
                    <td>
                        {{$tran->quantity}}

                    </td>

                    <td>
                        <?php
                            $transaction = App\OnlineProduct::where('id','=', $tran->product_id)->first();
                            $product = App\Model\Master\Product::where('id','=', $transaction->product_id)->first();
                        ?>
                        {{ $product->name }}
                    </td>

                    <td>
                        ${{ $tran->price }}
                    </td>
                </tr>
            @endforeach
        @endif

        <tr class="item">
            <td></td>
            <td></td>
            <td>
                <strong>Shipping</strong>: $0.00 <br>
                <strong>Tax</strong>: 0% <br>
                <strong>Total</strong>: ${{ $sale->total }}
            </td>
        </tr>

        <!-- /Product Information -->

    </table>
    <br><br>
    <h4 class="notes">ADDITIONAL NOTES</h4>
    <hr>
    <p>{{ $sale->orderNotes }}</p>
    <p><strong style="color: #9d9595;">Goods will only be delivered or shipped upon payment.</strong></p>
</div>
</body>
</html>

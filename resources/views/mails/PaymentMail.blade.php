<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="container">
  <div class="row">
    <div class="span4">
      <address>
        <?php


$products = Session::get('products');
$total = Session::get('total');
$without_discount_price = Session::get('without_discount_price');
$discount_price = Session::get('discount_price');
$extra_charge = Session::get('extra_charge');
$qrcode = Session::get('qrcode');
$invoice = Session::get('invoice');
$date = Session::get('date')

                    ?>

      </address>
    </div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Midway Dine</title>
      <style>
        body {
          margin: 0;
          padding: 0;
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          background-color: #f4f4f4;
        }

        .email-container {
          background: #ffffff;
          max-width: 700px;
          margin: 40px auto;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
          text-align: center;
          border-bottom: 2px solid #00b894;
          padding-bottom: 10px;
          margin-bottom: 20px;
        }

        .header h1 {
          color: #00b894;
          margin: 0;
        }

        .qr-code {
          text-align: right;
        }

        .details,
        .product-table {
          width: 100%;
          margin-top: 20px;
        }

        .details td {
          padding: 5px 10px;
          font-size: 14px;
        }

        .details td:first-child {
          font-weight: bold;
          color: #333;
        }

        .product-table th {
          background-color: #00b894;
          color: white;
          padding: 10px;
          text-align: center;
        }

        .product-table td {
          padding: 10px;
          text-align: center;
          border-bottom: 1px solid #eee;
        }

        .total-row td {
          font-weight: bold;
          background-color: #f8f8f8;
        }

        .footer {
          margin-top: 30px;
          font-size: 13px;
          text-align: center;
          color: #666;
        }
      </style>
    </head>

    <body>
      <div class="email-container">
        <div class="header">
          <h1>MidwayCafe</h1>
        </div>

        <div class="qr-code">
          <img src="data:image/png;base64, {!! $qrcode !!}" width="120">
        </div>

        <table class="details">
          <tr>
            <td>Invoice No</td>
            <td>{{ $invoice_no }}</td>
          </tr>
          <tr>
            <td>Customer Name</td>
            <td>{{ Auth::user()->name }}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>{{ Auth::user()->email }}</td>
          </tr>
          <tr>
            <td>Status</td>
            <td>Unpaid</td>
          </tr>
          <tr>
            <td>Payment Method</td>
            <td>Online Payment</td>
          </tr>
          <tr>
            <td>Date</td>
            <td>{{ $date }}</td>
          </tr>
        </table>

        <h3 style="margin-top: 40px;">Product Details</h3>
        <table class="product-table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
        <tr>
          <td>{{ $product->name }}</td>
          <td>{{ $product->price }} CAD</td>
          <td>{{ $product->quantity }}</td>
          <td>{{ $product->subtotal }} CAD</td>
        </tr>
      @endforeach

            @foreach($extra_charge as $charge)
        <tr>
          <td>{{ $charge->name }}</td>
          <td colspan="2"></td>
          <td>{{ $charge->price }} CAD</td>
        </tr>
      @endforeach

            <tr class="total-row">
              <td colspan="3">Subtotal</td>
              <td>{{ $without_discount_price }} CAD</td>
            </tr>
            <tr class="total-row">
              <td colspan="3">Discount</td>
              <td>{{ $discount_price }} CAD</td>
            </tr>
            <tr class="total-row">
              <td colspan="3">Total</td>
              <td>{{ $total }} CAD</td>
            </tr>
          </tbody>
        </table>

        <div class="footer">
          <p><strong>Humber Admin</strong></p>
          <p>Phone: (416)826-0732 | Email: chhetrikushal14@gmail.com</p>
          <p>Thank you for dining with us!</p>
        </div>
      </div>
    </body>

    </html>
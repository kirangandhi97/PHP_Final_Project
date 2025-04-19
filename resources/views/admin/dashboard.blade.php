@extends('admin/adminlayout')

@section('container')

  <!-- All your existing HTML and cards remain unchanged -->

  <!-- START: Best Rating Section -->
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
      <div class="d-flex flex-row justify-content-between">
      <h4 class="card-title mb-1">Best Rating</h4>
      <p class="text-muted mb-1">Voters</p>
      </div>
      <div class="row">
      <div class="col-12">
        <div class="preview-list">
        @php $i = 1; @endphp
        @foreach($per_rate as $prod)
        @if($i > 5)
      @break
    @endif
        @php
        $index_search = array_search($prod, $copy_product);
        $product_get = DB::table('products')->where('id', $index_search)->first();
        $copy_product[$index_search] = NULL;
        $voter = DB::table('rates')->where('product_id', $index_search)->count();
        $i++;
      @endphp

        @if($product_get)
      <div class="preview-item border-bottom">
        <div class="preview-thumbnail">
        <div class="preview-icon bg-primary">
        <img class="img-xs" src="{{ asset('assets/images/' . $product_get->image) }}" alt="">
        </div>
        </div>
        <div class="preview-item-content d-sm-flex flex-grow">
        <div class="flex-grow">
        <h6 class="preview-subject">{{ $product_get->name }}</h6>
        <p class="text-muted mb-0">Rating : {{ $prod }}</p>
        </div>
        <div class="me-auto text-sm-right pt-2 pt-sm-0">
        <p class="text-muted">{{ $voter }}</p>
        </div>
        </div>
      </div>
    @endif
    @endforeach
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- END: Best Rating Section -->

  <!-- START: Top Seller Table -->
  <div class="col-12 grid-margin">
    <div class="card">
    <div class="card-body">
      <h4 class="card-title">Top Seller</h4>
      <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th style="text-align:center;"> Product ID </th>
          <th style="text-align:center;"> Product Name </th>
          <th style="text-align:center;"> Price </th>
          <th style="text-align:center;"> Quantity </th>
        </tr>
        </thead>
        <tbody>
        @php $i = 1; @endphp
        @foreach($product_cart as $prod)
        @if($i > 5)
      @break
    @endif
        @php
        $index_search = array_search($prod, $copy_cart);
        $product_get = DB::table('products')->where('id', $index_search)->first();
        $copy_cart[$index_search] = NULL;
        $i++;
      @endphp

        @if($product_get)
      <tr>
        <td style="text-align:center;"> {{ $product_get->id }} </td>
        <td style="text-align:center;"> {{ $product_get->name }} </td>
        <td style="text-align:center;"> {{ $product_get->price }} </td>
        <td style="text-align:center;"> {{ $prod }} </td>
      </tr>
    @endif
    @endforeach
        </tbody>
      </table>
      </div>
    </div>
    </div>
  </div>
  <!-- END: Top Seller Table -->

@endsection

<script type="text/javascript">
  window.onload = function () {
    var cash_pay_value = "{{ $cash_on_payment }}";
    var online_pay_value = "{{ $online_payment }}";

    var chart = new CanvasJS.Chart("chartContainer", {
      theme: "dark2",
      animationEnabled: false,
      title: {
        text: ""
      },
      data: [
        {
          type: "column",
          dataPoints: [
            { label: "Cash on Delivery", y: +cash_pay_value },
            { label: "Online Payment", y: +online_pay_value },
          ]
        }
      ]
    });
    chart.render();
  }
</script>

<style>
  canvas {
    background-color: transparent;
    color: inherit;
  }
</style>
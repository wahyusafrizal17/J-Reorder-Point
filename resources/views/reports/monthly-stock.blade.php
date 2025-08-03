@extends('layouts.app')
@section('title','Laporan Stok Bulanan')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
         <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Laporan Stok Bulanan</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('reports.monthly-stock') }}">Laporan</a>
                                </li>
                                <li class="breadcrumb-item active">Stok Bulanan
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                  
                  <!-- Filter -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Filter Laporan</h4>
                          </div>
                           <div class="card-body">
                              <form method="GET" action="{{ route('reports.monthly-stock') }}">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="month">Bulan</label>
                                          <input type="month" class="form-control" id="month" name="month" 
                                                 value="{{ $month }}" onchange="this.form.submit()">
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Laporan Stok -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Laporan Stok Bulanan - {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h4>
                          </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                       <tr>
                                          <th style="width: 5%">No</th>
                                          <th>Kode Barang</th>
                                          <th>Nama Barang</th>
                                          <th>Kategori</th>
                                          <th>Stok Awal</th>
                                          <th>Barang Masuk</th>
                                          <th>Barang Keluar</th>
                                          <th>Stok Akhir</th>
                                          <th>Status</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $product->product_code }}</td>
                                          <td>{{ $product->name }}</td>
                                          <td>{{ $product->category }}</td>
                                          <td>{{ $product->current_stock - $product->stockIn->sum('quantity') + $product->stockOut->sum('quantity') }}</td>
                                          <td>
                                             <span class="badge bg-success">{{ $product->stockIn->sum('quantity') }}</span>
                                          </td>
                                          <td>
                                             <span class="badge bg-danger">{{ $product->stockOut->sum('quantity') }}</span>
                                          </td>
                                          <td>{{ $product->current_stock }}</td>
                                          <td>
                                             @if($product->current_stock <= $product->reorder_point)
                                                <span class="badge bg-warning">Stok Rendah</span>
                                             @else
                                                <span class="badge bg-success">Normal</span>
                                             @endif
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                    <!--/ List DataTable -->
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#basic-datatables').DataTable();
});
</script>
@endpush 
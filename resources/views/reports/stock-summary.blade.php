@extends('layouts.app')
@section('title','Ringkasan Stok')
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
                        <h2 class="content-header-title float-start mb-0">Ringkasan Stok</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('reports.stock-summary') }}">Laporan</a>
                                </li>
                                <li class="breadcrumb-item active">Ringkasan Stok
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
                  
                  <!-- Statistik -->
                  <div class="row">
                     <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                           <div class="card-header">
                              <div>
                                 <h2 class="fw-bolder mb-0">{{ $totalProducts }}</h2>
                                 <p class="card-text">Total Barang</p>
                              </div>
                              <div class="avatar bg-light-primary p-50 m-0">
                                 <div class="avatar-content">
                                    <i data-feather="package" class="text-primary font-medium-4"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                           <div class="card-header">
                              <div>
                                 <h2 class="fw-bolder mb-0">{{ $lowStockProducts }}</h2>
                                 <p class="card-text">Stok Rendah</p>
                              </div>
                              <div class="avatar bg-light-warning p-50 m-0">
                                 <div class="avatar-content">
                                    <i data-feather="alert-triangle" class="text-warning font-medium-4"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                           <div class="card-header">
                              <div>
                                 <h2 class="fw-bolder mb-0">{{ $outOfStockProducts }}</h2>
                                 <p class="card-text">Habis Stok</p>
                              </div>
                              <div class="avatar bg-light-danger p-50 m-0">
                                 <div class="avatar-content">
                                    <i data-feather="x-circle" class="text-danger font-medium-4"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                           <div class="card-header">
                              <div>
                                 <h2 class="fw-bolder mb-0">{{ $totalProducts - $lowStockProducts - $outOfStockProducts }}</h2>
                                 <p class="card-text">Stok Normal</p>
                              </div>
                              <div class="avatar bg-light-success p-50 m-0">
                                 <div class="avatar-content">
                                    <i data-feather="check-circle" class="text-success font-medium-4"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Daftar Barang -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Daftar Semua Barang</h4>
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
                                          <th>Stok Saat Ini</th>
                                          <th>Reorder Point</th>
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
                                          <td>{{ $product->current_stock }} {{ $product->unit }}</td>
                                          <td>{{ $product->reorder_point }} {{ $product->unit }}</td>
                                          <td>
                                             @if($product->current_stock == 0)
                                                <span class="badge bg-danger">Habis Stok</span>
                                             @elseif($product->current_stock <= $product->reorder_point)
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
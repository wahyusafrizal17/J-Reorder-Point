@extends('layouts.app')
@section('title','Dashboard - Reorder Point')
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
                        <h2 class="content-header-title float-start mb-0">Dashboard</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard
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
                  
                  <!-- Statistik Cards -->
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
                                 <h2 class="fw-bolder mb-0">{{ $normalStockProducts }}</h2>
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

                  <!-- Statistik Bulanan -->
                  <div class="row">
                     <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                           <div class="card-header">
                              <div>
                                 <h2 class="fw-bolder mb-0">{{ $monthlyStockIns }}</h2>
                                 <p class="card-text">Barang Masuk Bulan Ini</p>
                              </div>
                              <div class="avatar bg-light-success p-50 m-0">
                                 <div class="avatar-content">
                                    <i data-feather="arrow-down" class="text-success font-medium-4"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                           <div class="card-header">
                              <div>
                                 <h2 class="fw-bolder mb-0">{{ $monthlyStockOuts }}</h2>
                                 <p class="card-text">Barang Keluar Bulan Ini</p>
                              </div>
                              <div class="avatar bg-light-danger p-50 m-0">
                                 <div class="avatar-content">
                                    <i data-feather="arrow-up" class="text-danger font-medium-4"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Barang Perlu Reorder -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Barang yang Perlu Reorder</h4>
                              <a href="{{ route('reports.expired-products') }}" class="btn btn-warning btn-sm">
                                 <i data-feather='eye'></i> Lihat Semua
                              </a>
                          </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-striped">
                                    <thead>
                                       <tr>
                                          <th>Kode Barang</th>
                                          <th>Nama Barang</th>
                                          <th>Stok Saat Ini</th>
                                          <th>Reorder Point</th>
                                          <th>Status</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($productsNeedReorder as $product)
                                       <tr>
                                          <td>{{ $product->product_code }}</td>
                                          <td>{{ $product->name }}</td>
                                          <td>{{ $product->current_stock }} {{ $product->unit }}</td>
                                          <td>{{ $product->reorder_point }} {{ $product->unit }}</td>
                                          <td>
                                             @if($product->current_stock == 0)
                                                <span class="badge bg-danger">Habis Stok</span>
                                             @else
                                                <span class="badge bg-warning">Stok Rendah</span>
                                             @endif
                                          </td>
                                       </tr>
                                       @empty
                                       <tr>
                                          <td colspan="5" class="text-center">Tidak ada barang yang perlu reorder</td>
                                       </tr>
                                       @endforelse
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Aktivitas Terbaru -->
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Barang Masuk Terbaru</h4>
                              <a href="{{ route('stock-in.index') }}" class="btn btn-primary btn-sm">
                                 <i data-feather='list'></i> Lihat Semua
                              </a>
                          </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-striped">
                                    <thead>
                                       <tr>
                                          <th>Tanggal</th>
                                          <th>Barang</th>
                                          <th>Jumlah</th>
                                          <th>Supplier</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentStockIns as $stockIn)
                                       <tr>
                                          <td>{{ $stockIn->date->format('d/m/Y') }}</td>
                                          <td>{{ $stockIn->product->name }}</td>
                                          <td>{{ $stockIn->quantity }} {{ $stockIn->product->unit }}</td>
                                          <td>{{ $stockIn->supplier ?? '-' }}</td>
                                       </tr>
                                       @empty
                                       <tr>
                                          <td colspan="4" class="text-center">Belum ada transaksi barang masuk</td>
                                       </tr>
                                       @endforelse
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Barang Keluar Terbaru</h4>
                              <a href="{{ route('stock-out.index') }}" class="btn btn-primary btn-sm">
                                 <i data-feather='list'></i> Lihat Semua
                              </a>
                          </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-striped">
                                    <thead>
                                       <tr>
                                          <th>Tanggal</th>
                                          <th>Barang</th>
                                          <th>Jumlah</th>
                                          <th>Customer</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentStockOuts as $stockOut)
                                       <tr>
                                          <td>{{ $stockOut->date->format('d/m/Y') }}</td>
                                          <td>{{ $stockOut->product->name }}</td>
                                          <td>{{ $stockOut->quantity }} {{ $stockOut->product->unit }}</td>
                                          <td>{{ $stockOut->customer ?? '-' }}</td>
                                       </tr>
                                       @empty
                                       <tr>
                                          <td colspan="4" class="text-center">Belum ada transaksi barang keluar</td>
                                       </tr>
                                       @endforelse
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Quick Actions -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Quick Actions</h4>
                          </div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-3">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-block mb-2">
                                       <i data-feather="plus"></i> Tambah Barang
                                    </a>
                                 </div>
                                 <div class="col-md-3">
                                    <a href="{{ route('stock-in.create') }}" class="btn btn-success btn-block mb-2">
                                       <i data-feather="arrow-down"></i> Barang Masuk
                                    </a>
                                 </div>
                                 <div class="col-md-3">
                                    <a href="{{ route('stock-out.create') }}" class="btn btn-danger btn-block mb-2">
                                       <i data-feather="arrow-up"></i> Barang Keluar
                                    </a>
                                 </div>
                                 <div class="col-md-3">
                                    <a href="{{ route('reports.expired-products') }}" class="btn btn-warning btn-block mb-2">
                                       <i data-feather="alert-triangle"></i> Cek Stok
                                    </a>
                                 </div>
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

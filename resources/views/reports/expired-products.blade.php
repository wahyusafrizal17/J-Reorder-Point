@extends('layouts.app')
@section('title','Identifikasi Barang Kedaluwarsa')
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
                        <h2 class="content-header-title float-start mb-0">Identifikasi Barang Kedaluwarsa</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('reports.expired-products') }}">Laporan</a>
                                </li>
                                <li class="breadcrumb-item active">Barang Kedaluwarsa
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
                  
                  <!-- Barang dengan Stok Rendah -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Barang dengan Stok Rendah (Di Bawah Reorder Point)</h4>
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
                                        @foreach($expiredProducts as $row)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $row->product_code }}</td>
                                          <td>{{ $row->name }}</td>
                                          <td>{{ $row->category }}</td>
                                          <td>
                                             <span class="badge bg-warning">{{ $row->current_stock }} {{ $row->unit }}</span>
                                          </td>
                                          <td>{{ $row->reorder_point }} {{ $row->unit }}</td>
                                          <td>
                                             <span class="badge bg-danger">Perlu Reorder</span>
                                          </td>
                                       </tr>
                                       @endforeach
                                       @if($expiredProducts->count() == 0)
                                       <tr>
                                          <td colspan="7" class="text-center">Tidak ada barang dengan stok rendah</td>
                                       </tr>
                                       @endif
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Barang Habis Stok -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Barang Habis Stok</h4>
                          </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table id="basic-datatables2" class="display table table-striped table-hover">
                                    <thead>
                                       <tr>
                                          <th style="width: 5%">No</th>
                                          <th>Kode Barang</th>
                                          <th>Nama Barang</th>
                                          <th>Kategori</th>
                                          <th>Reorder Point</th>
                                          <th>Status</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($outOfStock as $row)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $row->product_code }}</td>
                                          <td>{{ $row->name }}</td>
                                          <td>{{ $row->category }}</td>
                                          <td>{{ $row->reorder_point }} {{ $row->unit }}</td>
                                          <td>
                                             <span class="badge bg-danger">Habis Stok</span>
                                          </td>
                                       </tr>
                                       @endforeach
                                       @if($outOfStock->count() == 0)
                                       <tr>
                                          <td colspan="6" class="text-center">Tidak ada barang yang habis stok</td>
                                       </tr>
                                       @endif
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
    $('#basic-datatables2').DataTable();
});
</script>
@endpush 
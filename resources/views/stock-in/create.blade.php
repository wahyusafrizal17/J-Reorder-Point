@extends('layouts.app')
@section('title','Tambah Barang Masuk')
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
                        <h2 class="content-header-title float-start mb-0">Tambah Barang Masuk</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('stock-in.index') }}">Barang Masuk</a>
                                </li>
                                <li class="breadcrumb-item active">Tambah
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
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Form Tambah Barang Masuk</h4>
                          </div>
                           <div class="card-body">
                              <form action="{{ route('stock-in.store') }}" method="POST">
                                 @csrf
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="product_id">Barang <span class="text-danger">*</span></label>
                                          <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                             <option value="">Pilih Barang</option>
                                             @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                                   {{ $product->product_code }} - {{ $product->name }}
                                                </option>
                                             @endforeach
                                          </select>
                                          @error('product_id')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="quantity">Jumlah <span class="text-danger">*</span></label>
                                          <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                                 id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" required>
                                          @error('quantity')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="date">Tanggal <span class="text-danger">*</span></label>
                                          <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                                 id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                                          @error('date')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="supplier">Supplier</label>
                                          <input type="text" class="form-control @error('supplier') is-invalid @enderror" 
                                                 id="supplier" name="supplier" value="{{ old('supplier') }}">
                                          @error('supplier')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="notes">Keterangan</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                                              id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                       <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('stock-in.index') }}" class="btn btn-secondary">Kembali</a>
                                 </div>
                              </form>
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
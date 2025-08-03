@extends('layouts.app')
@section('title','Tambah Barang')
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
                        <h2 class="content-header-title float-start mb-0">Tambah Barang</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Barang</a>
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
                              <h4 class="card-title">Form Tambah Barang</h4>
                          </div>
                           <div class="card-body">
                              <form action="{{ route('products.store') }}" method="POST">
                                 @csrf
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="product_code">Kode Barang <span class="text-danger">*</span></label>
                                          <input type="text" class="form-control @error('product_code') is-invalid @enderror" 
                                                 id="product_code" name="product_code" value="{{ old('product_code') }}" required>
                                          @error('product_code')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="name">Nama Barang <span class="text-danger">*</span></label>
                                          <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                 id="name" name="name" value="{{ old('name') }}" required>
                                          @error('name')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="category">Kategori <span class="text-danger">*</span></label>
                                          <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                                             <option value="">Pilih Kategori</option>
                                             <option value="Elektronik" {{ old('category') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                             <option value="Pakaian" {{ old('category') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                             <option value="Makanan" {{ old('category') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                             <option value="Minuman" {{ old('category') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                             <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                          </select>
                                          @error('category')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="unit">Satuan <span class="text-danger">*</span></label>
                                          <select class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" required>
                                             <option value="">Pilih Satuan</option>
                                             <option value="PCS" {{ old('unit') == 'PCS' ? 'selected' : '' }}>PCS</option>
                                             <option value="BOX" {{ old('unit') == 'BOX' ? 'selected' : '' }}>BOX</option>
                                             <option value="KG" {{ old('unit') == 'KG' ? 'selected' : '' }}>KG</option>
                                             <option value="LITER" {{ old('unit') == 'LITER' ? 'selected' : '' }}>LITER</option>
                                             <option value="METER" {{ old('unit') == 'METER' ? 'selected' : '' }}>METER</option>
                                          </select>
                                          @error('unit')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="reorder_point">Reorder Point <span class="text-danger">*</span></label>
                                          <input type="number" class="form-control @error('reorder_point') is-invalid @enderror" 
                                                 id="reorder_point" name="reorder_point" value="{{ old('reorder_point') }}" min="0" required>
                                          @error('reorder_point')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="price">Harga <span class="text-danger">*</span></label>
                                          <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                                 id="price" name="price" value="{{ old('price') }}" min="0" required>
                                          @error('price')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                       <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                 </div>
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
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
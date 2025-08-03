@extends('layouts.app')
@section('title','Welcome - Reorder Point System')
@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Selamat Datang di Reorder Point</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Welcome</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Welcome Section -->
            <section id="welcome-section">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <i data-feather="package" class="text-primary" style="width: 64px; height: 64px;"></i>
                                </div>
                                <h1 class="card-title text-primary mb-2">Reorder Point System</h1>
                                <p class="card-text lead">Sistem Manajemen Inventori yang Efisien untuk Mengoptimalkan Stok Anda</p>
                                <p class="card-text">Kelola stok barang, monitor reorder point, dan lakukan pengadaan tepat waktu dengan sistem yang terintegrasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Feature Cards -->
            <section id="feature-cards">
                <div class="row match-height">
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <i data-feather="database" class="text-primary" style="width: 48px; height: 48px;"></i>
                                </div>
                                <h4 class="card-title">Data Master Barang</h4>
                                <p class="card-text">Kelola data master barang dengan informasi lengkap termasuk kode, nama, kategori, satuan, dan reorder point.</p>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                    <i data-feather="list"></i> Kelola Barang
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <i data-feather="arrow-down" class="text-success" style="width: 48px; height: 48px;"></i>
                                </div>
                                <h4 class="card-title">Barang Masuk</h4>
                                <p class="card-text">Catat transaksi barang masuk dengan detail supplier, jumlah, dan tanggal untuk tracking yang akurat.</p>
                                <a href="{{ route('stock-in.index') }}" class="btn btn-outline-success">
                                    <i data-feather="plus"></i> Barang Masuk
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <i data-feather="arrow-up" class="text-danger" style="width: 48px; height: 48px;"></i>
                                </div>
                                <h4 class="card-title">Barang Keluar</h4>
                                <p class="card-text">Kelola pengeluaran barang dengan validasi stok otomatis dan pencatatan customer yang terstruktur.</p>
                                <a href="{{ route('stock-out.index') }}" class="btn btn-outline-danger">
                                    <i data-feather="minus"></i> Barang Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Additional Features -->
            <section id="additional-features">
                <div class="row match-height">
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <i data-feather="alert-triangle" class="text-warning" style="width: 48px; height: 48px;"></i>
                                </div>
                                <h5 class="card-title">Monitoring Stok</h5>
                                <p class="card-text">Peringatan otomatis untuk barang dengan stok rendah dan habis stok.</p>
                                <a href="{{ route('reports.expired-products') }}" class="btn btn-outline-warning btn-sm">
                                    <i data-feather="eye"></i> Cek Stok
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <i data-feather="file-text" class="text-info" style="width: 48px; height: 48px;"></i>
                                </div>
                                <h5 class="card-title">Laporan Bulanan</h5>
                                <p class="card-text">Laporan stok bulanan dengan perhitungan masuk, keluar, dan saldo akhir.</p>
                                <a href="{{ route('reports.monthly-stock') }}" class="btn btn-outline-info btn-sm">
                                    <i data-feather="calendar"></i> Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <i data-feather="bar-chart-2" class="text-primary" style="width: 48px; height: 48px;"></i>
                                </div>
                                <h5 class="card-title">Ringkasan Stok</h5>
                                <p class="card-text">Dashboard ringkasan dengan statistik real-time untuk monitoring cepat.</p>
                                <a href="{{ route('reports.stock-summary') }}" class="btn btn-outline-primary btn-sm">
                                    <i data-feather="activity"></i> Ringkasan
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    <i data-feather="trending-up" class="text-success" style="width: 48px; height: 48px;"></i>
                                </div>
                                <h5 class="card-title">Pergerakan Stok</h5>
                                <p class="card-text">Analisis pergerakan stok untuk periode tertentu dengan detail transaksi.</p>
                                <a href="{{ route('reports.stock-movement') }}" class="btn btn-outline-success btn-sm">
                                    <i data-feather="trending-up"></i> Analisis
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Quick Actions -->
            <section id="quick-actions">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Quick Actions</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 mb-2">
                                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-block w-100">
                                            <i data-feather="plus"></i> Tambah Barang Baru
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2">
                                        <a href="{{ route('stock-in.create') }}" class="btn btn-success btn-block w-100">
                                            <i data-feather="arrow-down"></i> Catat Barang Masuk
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2">
                                        <a href="{{ route('stock-out.create') }}" class="btn btn-danger btn-block w-100">
                                            <i data-feather="arrow-up"></i> Catat Barang Keluar
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2">
                                        <a href="{{ route('reports.expired-products') }}" class="btn btn-warning btn-block w-100">
                                            <i data-feather="alert-triangle"></i> Cek Stok Rendah
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- System Info -->
            <section id="system-info">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tentang Sistem</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Fitur Utama:</h5>
                                        <ul class="list-unstyled">
                                            <li><i data-feather="check" class="text-success me-2"></i> Manajemen data master barang</li>
                                            <li><i data-feather="check" class="text-success me-2"></i> Pencatatan barang masuk dan keluar</li>
                                            <li><i data-feather="check" class="text-success me-2"></i> Monitoring reorder point otomatis</li>
                                            <li><i data-feather="check" class="text-success me-2"></i> Laporan stok bulanan</li>
                                            <li><i data-feather="check" class="text-success me-2"></i> Identifikasi barang kedaluwarsa</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Keunggulan:</h5>
                                        <ul class="list-unstyled">
                                            <li><i data-feather="star" class="text-warning me-2"></i> Interface yang user-friendly</li>
                                            <li><i data-feather="star" class="text-warning me-2"></i> Validasi stok real-time</li>
                                            <li><i data-feather="star" class="text-warning me-2"></i> Laporan yang komprehensif</li>
                                            <li><i data-feather="star" class="text-warning me-2"></i> Sistem peringatan otomatis</li>
                                            <li><i data-feather="star" class="text-warning me-2"></i> Data yang terstruktur dan aman</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
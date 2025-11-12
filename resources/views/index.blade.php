@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    :root {
        --primary: #8B6B4A;
        --secondary: #A99275;
        --background: #FFFFFF;
        --surface: #F9F7F5;
        --text: #333333;
        --text-light: #777777;
        --border: #EAEAEA;
    }

    .page-container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .welcome {
        margin-bottom: 2rem;
    }
    
    .card {
        background: var(--background);
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        border: none;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .stat-card {
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:hover {
        background: var(--surface);
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: var(--text-light);
        margin-bottom: 0.5rem;
    }
    
    .stat-value {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 0.25rem;
    }
    
    .stat-trend {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        display: inline-block;
        background: rgba(139, 107, 74, 0.1);
        color: var(--primary);
    }
    
    .trend-up {
        color: #2d9d78;
        background: rgba(45, 157, 120, 0.1);
    }
    
    .trend-down {
        color: #e15241;
        background: rgba(225, 82, 65, 0.1);
    }
    
    .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .main-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .activity-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border);
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background: var(--surface);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-title {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    
    .activity-time {
        font-size: 0.75rem;
        color: var(--text-light);
    }
    
    .section-title {
        font-size: 1.125rem;
        font-weight: 500;
        margin-bottom: 1.25rem;
        color: var(--text);
    }
    
    .action-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }
    
    .action-item {
        display: flex;
        align-items: center;
        padding: 0.875rem;
        background: var(--surface);
        border-radius: 6px;
        color: var(--text);
        text-decoration: none;
        transition: all 0.15s ease;
    }
    
    .action-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }
    
    .action-icon {
        width: 24px;
        height: 24px;
        border-radius: 4px;
        background: var(--background);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        margin-right: 0.75rem;
    }
    
    .action-label {
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .today-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
    }
    
    .today-item:last-child {
        border-bottom: none;
    }
    
    .today-time {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        background: var(--surface);
        color: var(--primary);
        margin-right: 0.75rem;
        min-width: 70px;
        text-align: center;
    }
    
    .today-title {
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        text-align: center;
        border: none;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text);
    }
    
    .btn-outline:hover {
        background: var(--surface);
    }
</style>
@endpush

@section('content')
<div class="page-container">
    <!-- Welcome Section -->
    <div class="welcome">
        <h2 style="margin-bottom: 0.25rem; color: var(--text);">Selamat Datang, {{ Auth::user()->name }}</h2>
        <p style="color: var(--text-light); margin-bottom: 0;">{{ date('l, d F Y') }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="card stat-card">
            <div class="stat-label">Total Pengguna</div>
            <div class="stat-value">1,245</div>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up" style="font-size: 8px;"></i> 12%
            </div>
        </div>
        
        <div class="card stat-card">
            <div class="stat-label">Pendapatan</div>
            <div class="stat-value">$8,542</div>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up" style="font-size: 8px;"></i> 8%
            </div>
        </div>
        
        <div class="card stat-card">
            <div class="stat-label">Total Produk</div>
            <div class="stat-value">324</div>
            <div class="stat-trend trend-down">
                <i class="fas fa-arrow-down" style="font-size: 8px;"></i> 3%
            </div>
        </div>
        
        <div class="card stat-card">
            <div class="stat-label">Aktivitas Hari Ini</div>
            <div class="stat-value">48</div>
            <div class="stat-trend trend-up">
                <i class="fas fa-arrow-up" style="font-size: 8px;"></i> 22%
            </div>
        </div>
    </div>

    <div class="main-grid">
        <!-- Recent Activities -->
        <div class="card">
            <div style="padding: 1.5rem;">
                <h3 class="section-title">Aktivitas Terkini</h3>
                
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-plus" style="font-size: 14px;"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Pengguna baru terdaftar</div>
                        <div style="color: var(--text-light); font-size: 0.875rem; margin-bottom: 0.25rem;">John Doe mendaftar sebagai pengguna baru</div>
                        <div class="activity-time">10 menit yang lalu</div>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart" style="font-size: 14px;"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Pesanan baru</div>
                        <div style="color: var(--text-light); font-size: 0.875rem; margin-bottom: 0.25rem;">Pesanan #1234 telah dibuat</div>
                        <div class="activity-time">1 jam yang lalu</div>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-tasks" style="font-size: 14px;"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Tugas selesai</div>
                        <div style="color: var(--text-light); font-size: 0.875rem; margin-bottom: 0.25rem;">Tugas "Update Dashboard" telah diselesaikan</div>
                        <div class="activity-time">3 jam yang lalu</div>
                    </div>
                </div>
                
                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="#" class="btn btn-outline">Lihat Semua Aktivitas</a>
                </div>
            </div>
        </div>
        
        <!-- Right Column -->
        <div>
            <!-- Quick Actions -->
            <div class="card">
                <div style="padding: 1.5rem;">
                    <h3 class="section-title">Aksi Cepat</h3>
                    <div class="action-grid">
                        <a href="#" class="action-item">
                            <div class="action-icon">
                                <i class="fas fa-plus" style="font-size: 12px;"></i>
                            </div>
                            <span class="action-label">Tambah Produk</span>
                        </a>
                        
                        <a href="#" class="action-item">
                            <div class="action-icon">
                                <i class="fas fa-users" style="font-size: 12px;"></i>
                            </div>
                            <span class="action-label">Kelola Pengguna</span>
                        </a>
                        
                        <a href="#" class="action-item">
                            <div class="action-icon">
                                <i class="fas fa-chart-line" style="font-size: 12px;"></i>
                            </div>
                            <span class="action-label">Lihat Laporan</span>
                        </a>
                        
                        <a href="#" class="action-item">
                            <div class="action-icon">
                                <i class="fas fa-cog" style="font-size: 12px;"></i>
                            </div>
                            <span class="action-label">Pengaturan</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Today's Schedule -->
            <div class="card">
                <div style="padding: 1.5rem;">
                    <h3 class="section-title">Jadwal Hari Ini</h3>
                    
                    <div class="today-item">
                        <div class="today-time">10:00</div>
                        <div>
                            <div class="today-title">Meeting Tim Marketing</div>
                            <div style="font-size: 0.75rem; color: var(--text-light);">Ruang Rapat Utama</div>
                        </div>
                    </div>
                    
                    <div class="today-item">
                        <div class="today-time">13:30</div>
                        <div>
                            <div class="today-title">Diskusi Vendor</div>
                            <div style="font-size: 0.75rem; color: var(--text-light);">Online Meeting</div>
                        </div>
                    </div>
                    
                    <div class="today-item">
                        <div class="today-time">15:00</div>
                        <div>
                            <div class="today-title">Review Produk Baru</div>
                            <div style="font-size: 0.75rem; color: var(--text-light);">Ruang Kreasi</div>
                        </div>
                    </div>
                    
                    <div style="text-align: center; margin-top: 1rem;">
                        <a href="#" class="btn btn-outline">
                            <i class="fas fa-calendar-alt" style="font-size: 12px; margin-right: 0.5rem;"></i> Lihat Kalender
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
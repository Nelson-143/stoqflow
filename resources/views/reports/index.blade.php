@extends('layouts.tabler')

@section('title', 'Business Reports')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    {{ __('Analytics & Insights') }}
                </div>
                <h2 class="page-title">
                    {{ __('Business Reports') }}
                </h2>
                <div class="text-muted mt-1">
                    {{ __('Comprehensive overview of your business performance') }}
                </div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 11l5 5l5 -5" />
                                <path d="M12 4l0 12" />
                            </svg>
                            Export Report
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Download PDF</a>
                            <a class="dropdown-item" href="#">Export Excel</a>
                            <a class="dropdown-item" href="#">Print Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <!-- KPI Cards Row -->
        <div class="row row-deck row-cards mb-4">
            @php
                $kpis = [
                    ['title' => 'Total Sales', 'value' => $carts ?? 0, 'color' => 'success', 'icon' => 'currency-dollar', 'trend' => '+12.5%', 'trendUp' => true],
                    ['title' => 'Total Expenses', 'value' => $totalExpenses ?? 0, 'color' => 'danger', 'icon' => 'trending-down', 'trend' => '+5.2%', 'trendUp' => false],
                    ['title' => 'Net Profit', 'value' => $profit ?? 0, 'color' => 'primary', 'icon' => 'trophy', 'trend' => '+8.3%', 'trendUp' => true],
                    ['title' => 'Stock Value', 'value' => $totalStockValue ?? 0, 'color' => 'info', 'icon' => 'packages', 'trend' => ($totalAvailableStock ?? 0) . ' items', 'trendUp' => null]
                ];
            @endphp

            @foreach($kpis as $kpi)
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-{{ $kpi['color'] }} text-white avatar avatar-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        @if($kpi['icon'] == 'currency-dollar')
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                            <path d="M12 6v2m0 8v2" />
                                        @elseif($kpi['icon'] == 'trending-down')
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 7l6 6l4 -4l8 8" />
                                            <path d="M21 10l0 7l-7 0" />
                                        @elseif($kpi['icon'] == 'trophy')
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 2l3.09 6.26l6.91 1l-5 4.87l1.18 6.88l-6.18 -3.25l-6.18 3.25l1.18 -6.88l-5 -4.87l6.91 -1z" />
                                        @else
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                            <path d="M2 13.5v5.5l5 3" />
                                            <path d="M7 16.545l5 -3.03" />
                                            <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                            <path d="M12 19l5 3" />
                                        @endif
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="text-muted small text-uppercase ls-wide">{{ $kpi['title'] }}</div>
                                <div class="h2 mb-0 text-{{ $kpi['color'] }}">{{ number_format($kpi['value'], 2) }}</div>
                                @if($kpi['trendUp'] !== null)
                                    <div class="small {{ $kpi['trendUp'] ? 'text-success' : 'text-danger' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            @if($kpi['trendUp'])
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M3 17l6 -6l4 4l8 -8" />
                                            @else
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M3 7l6 6l4 -4l8 8" />
                                            @endif
                                        </svg>
                                        {{ $kpi['trend'] }} vs last period
                                    </div>
                                @else
                                    <div class="small text-muted">{{ $kpi['trend'] }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Charts Row -->
        <div class="row row-deck row-cards mb-4">
            <!-- Main Trend Chart -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 3v18h18" />
                                <path d="M18 17v-7" />
                                <path d="M13 17v-11" />
                                <path d="M8 17v-4" />
                            </svg>
                            Sales & Expenses Trend
                        </h3>
                        <div class="card-actions">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary active">Daily</button>
                                <button class="btn btn-sm btn-outline-secondary">Weekly</button>
                                <button class="btn btn-sm btn-outline-secondary">Monthly</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 320px; position: relative;">
                            <canvas id="chart-trend"></canvas>

                            <!-- Empty State Overlay -->
                            @if(empty($chartData) || count(array_filter($chartData)) === 0)
                            <div class="chart-empty-state">
                                <div class="text-center">
                                    <div class="chart-placeholder mb-3">
                                        <svg viewBox="0 0 400 200" class="placeholder-svg">
                                            <!-- Grid lines -->
                                            <line x1="50" y1="20" x2="50" y2="180" stroke="#e5e7eb" stroke-width="1"/>
                                            <line x1="50" y1="180" x2="380" y2="180" stroke="#e5e7eb" stroke-width="1"/>
                                            <!-- Dotted trend line -->
                                            <path d="M50 150 Q100 140, 150 130 T250 110 T350 90"
                                                  fill="none"
                                                  stroke="#cbd5e1"
                                                  stroke-width="2"
                                                  stroke-dasharray="8,4"/>
                                            <!-- Data points -->
                                            <circle cx="50" cy="150" r="4" fill="#cbd5e1"/>
                                            <circle cx="150" cy="130" r="4" fill="#cbd5e1"/>
                                            <circle cx="250" cy="110" r="4" fill="#cbd5e1"/>
                                            <circle cx="350" cy="90" r="4" fill="#cbd5e1"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-muted mb-1">No Data Available</h4>
                                    <p class="text-muted small mb-3">Start recording transactions to see your sales trend</p>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Add Transaction
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donut Charts Column -->
            <div class="col-lg-4">
                <div class="row g-3">
                    <!-- Stock Status Donut -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="card-title fs-6">Stock Status</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row align-items-center">
                                    <div class="col-5">
                                        <div class="chart-container" style="height: 140px; position: relative;">
                                            <canvas id="chart-stock-donut"></canvas>

                                            @php
                                                $totalStock = ($totalAvailableStock ?? 0) + ($lowStockItems ?? 0) + ($outOfStockItems ?? 0);
                                            @endphp

                                            @if($totalStock == 0)
                                            <div class="chart-empty-state-small">
                                                <div class="donut-placeholder">
                                                    <svg viewBox="0 0 100 100" class="placeholder-svg">
                                                        <circle cx="50" cy="50" r="35" fill="none" stroke="#e5e7eb" stroke-width="12"/>
                                                        <circle cx="50" cy="50" r="35" fill="none" stroke="#cbd5e1" stroke-width="12"
                                                                stroke-dasharray="55,165" stroke-linecap="round" transform="rotate(-90 50 50)"/>
                                                        <circle cx="50" cy="50" r="35" fill="none" stroke="#94a3b8" stroke-width="12"
                                                                stroke-dasharray="33,165" stroke-dashoffset="-55" stroke-linecap="round" transform="rotate(-90 50 50)"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        @if($totalStock > 0)
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span class="text-muted">Available</span>
                                                <span class="text-success fw-bold">{{ number_format($totalAvailableStock ?? 0) }}</span>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" style="width: {{ $totalStock > 0 ? (($totalAvailableStock ?? 0) / $totalStock * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span class="text-muted">Low Stock</span>
                                                <span class="text-warning fw-bold">{{ number_format($lowStockItems ?? 0) }}</span>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning" style="width: {{ $totalStock > 0 ? (($lowStockItems ?? 0) / $totalStock * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span class="text-muted">Out of Stock</span>
                                                <span class="text-danger fw-bold">{{ number_format($outOfStockItems ?? 0) }}</span>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger" style="width: {{ $totalStock > 0 ? (($outOfStockItems ?? 0) / $totalStock * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="text-center py-2">
                                            <div class="text-muted small mb-2">No inventory data</div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Add Stock</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profit Distribution Donut -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="card-title fs-6">Financial Distribution</h4>
                            </div>
                            <div class="card-body pt-0">
                                @php
                                    $totalFinancial = ($profit ?? 0) + ($totalExpenses ?? 0) + ($incomeStatement['cogs'] ?? 0);
                                @endphp

                                <div class="row align-items-center">
                                    <div class="col-5">
                                        <div class="chart-container" style="height: 140px; position: relative;">
                                            <canvas id="chart-profit-donut"></canvas>

                                            @if($totalFinancial == 0)
                                            <div class="chart-empty-state-small">
                                                <div class="donut-placeholder">
                                                    <svg viewBox="0 0 100 100" class="placeholder-svg">
                                                        <circle cx="50" cy="50" r="35" fill="none" stroke="#e5e7eb" stroke-width="12"/>
                                                        <circle cx="50" cy="50" r="35" fill="none" stroke="#22c55e" stroke-width="12"
                                                                stroke-dasharray="35,165" stroke-linecap="round" transform="rotate(-90 50 50)"/>
                                                        <circle cx="50" cy="50" r="35" fill="none" stroke="#ef4444" stroke-width="12"
                                                                stroke-dasharray="50,165" stroke-dashoffset="-35" stroke-linecap="round" transform="rotate(-90 50 50)"/>
                                                        <circle cx="50" cy="50" r="35" fill="none" stroke="#3b82f6" stroke-width="12"
                                                                stroke-dasharray="80,165" stroke-dashoffset="-85" stroke-linecap="round" transform="rotate(-90 50 50)"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        @if($totalFinancial > 0)
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge bg-success me-2">&nbsp;</span>
                                            <div class="flex-fill">
                                                <div class="d-flex justify-content-between small">
                                                    <span class="text-muted">Net Profit</span>
                                                    <span class="fw-bold">{{ number_format($profit ?? 0, 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge bg-danger me-2">&nbsp;</span>
                                            <div class="flex-fill">
                                                <div class="d-flex justify-content-between small">
                                                    <span class="text-muted">Expenses</span>
                                                    <span class="fw-bold">{{ number_format($totalExpenses ?? 0, 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary me-2">&nbsp;</span>
                                            <div class="flex-fill">
                                                <div class="d-flex justify-content-between small">
                                                    <span class="text-muted">COGS</span>
                                                    <span class="fw-bold">{{ number_format($incomeStatement['cogs'] ?? 0, 0) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="text-center py-2">
                                            <div class="text-muted small mb-2">No financial data</div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Record Sale</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Metrics -->
        <div class="row row-deck row-cards mb-4">
            <div class="col-md-4">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green-lt text-green avatar avatar-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 2l3.09 6.26l6.91 1l-5 4.87l1.18 6.88l-6.18 -3.25l-6.18 3.25l1.18 -6.88l-5 -4.87l6.91 -1z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Gross Margin</div>
                                <div class="text-muted small">{{ isset($grossMargin) ? number_format($grossMargin, 1) : '0.0' }}%</div>
                            </div>
                            <div class="col-auto">
                                <span class="text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 17l6 -6l4 4l8 -8" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-red-lt text-red avatar avatar-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 2l3.09 6.26l6.91 1l-5 4.87l1.18 6.88l-6.18 -3.25l-6.18 3.25l1.18 -6.88l-5 -4.87l6.91 -1z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Expense Ratio</div>
                                <div class="text-muted small">{{ isset($expenseRatio) ? number_format($expenseRatio, 1) : '0.0' }}%</div>
                            </div>
                            <div class="col-auto">
                                <span class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 7l6 6l4 -4l8 8" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-blue-lt text-blue avatar avatar-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 2l3.09 6.26l6.91 1l-5 4.87l1.18 6.88l-6.18 -3.25l-6.18 3.25l1.18 -6.88l-5 -4.87l6.91 -1z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">YTD Performance</div>
                                <div class="text-muted small">{{ isset($ytdPerformance) ? number_format($ytdPerformance, 0) : '0' }}</div>
                            </div>
                            <div class="col-auto">
                                <span class="text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 17l6 -6l4 4l8 -8" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Statements -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                        <path d="M4 8l16 0" />
                        <path d="M8 4l0 4" />
                    </svg>
                    Financial Statements
                </h3>
                <div class="card-actions">
                    <ul class="nav nav-pills card-header-pills" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#income" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Income Statement</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#cashflow" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Cash Flow</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Income Statement -->
                    <div class="tab-pane fade show active" id="income" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                @php
                                    $hasIncomeData = ($incomeStatement['revenue'] ?? 0) > 0 || ($incomeStatement['cogs'] ?? 0) > 0 || ($incomeStatement['expenses'] ?? 0) > 0;
                                @endphp

                                @if($hasIncomeData)
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th class="text-end">Amount ({{ auth()->user()->account->currency ?? 'TZS' }})</th>
                                                <th class="text-end">% of Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-success-lt text-success me-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M12 5l0 14" />
                                                                <path d="M5 12l14 0" />
                                                            </svg>
                                                        </span>
                                                        <span class="fw-medium">Revenue</span>
                                                    </div>
                                                </td>
                                                <td class="text-end fw-bold text-success">{{ number_format($incomeStatement['revenue'] ?? 0, 2) }}</td>
                                                <td class="text-end">100%</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-5">
                                                    <span class="text-muted">Cost of Goods Sold</span>
                                                </td>
                                                <td class="text-end text-danger">-{{ number_format($incomeStatement['cogs'] ?? 0, 2) }}</td>
                                                <td class="text-end text-muted">{{ isset($incomeStatement['revenue']) && $incomeStatement['revenue'] > 0 ? number_format(($incomeStatement['cogs'] / $incomeStatement['revenue']) * 100, 1) : '0.0' }}%</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="fw-bold ps-4">Gross Profit</td>
                                                <td class="text-end fw-bold">{{ number_format($incomeStatement['grossProfit'] ?? 0, 2) }}</td>
                                                <td class="text-end fw-bold text-muted">{{ isset($incomeStatement['revenue']) && $incomeStatement['revenue'] > 0 ? number_format(($incomeStatement['grossProfit'] / $incomeStatement['revenue']) * 100, 1) : '0.0' }}%</td>
                                            </tr>
                                            <tr>
                                                <td class="ps-5">
                                                    <span class="text-muted">Operating Expenses</span>
                                                </td>
                                                <td class="text-end text-danger">-{{ number_format($incomeStatement['expenses'] ?? 0, 2) }}</td>
                                                <td class="text-end text-muted">{{ isset($incomeStatement['revenue']) && $incomeStatement['revenue'] > 0 ? number_format(($incomeStatement['expenses'] / $incomeStatement['revenue']) * 100, 1) : '0.0' }}%</td>
                                            </tr>
                                            <tr class="bg-primary-lt">
                                                <td class="fw-bold ps-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-primary" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 2l3.09 6.26l6.91 1l-5 4.87l1.18 6.88l-6.18 -3.25l-6.18 3.25l1.18 -6.88l-5 -4.87l6.91 -1z" />
                                                    </svg>
                                                    Net Income
                                                </td>
                                                <td class="text-end fw-bold text-primary h4 mb-0">{{ number_format($incomeStatement['netIncome'] ?? 0, 2) }}</td>
                                                <td class="text-end fw-bold text-primary">{{ isset($incomeStatement['revenue']) && $incomeStatement['revenue'] > 0 ? number_format(($incomeStatement['netIncome'] / $incomeStatement['revenue']) * 100, 1) : '0.0' }}%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="empty">
                                    <div class="empty-img">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calculator-off" width="64" height="64" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 4h10a2 2 0 0 1 2 2v10m-2 2h-10a2 2 0 0 1 -2 -2v-10" />
                                            <path d="M12 8h4" />
                                            <path d="M12 12h4" />
                                            <path d="M8 8h.01" />
                                            <path d="M8 12h.01" />
                                            <path d="M8 16h.01" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                    </div>
                                    <p class="empty-title h3">No Financial Data</p>
                                    <p class="empty-subtitle text-muted">Record your first sale to generate the income statement</p>
                                    <div class="empty-action">
                                        <a href="#" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg>
                                            Add First Sale
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <div class="chart-container" style="height: 280px; position: relative;">
                                    <canvas id="chart-income-breakdown"></canvas>

                                    @if(!$hasIncomeData)
                                    <div class="chart-empty-state-small">
                                        <div class="text-center">
                                            <svg viewBox="0 0 200 200" class="placeholder-svg mb-2" style="width: 120px;">
                                                <circle cx="100" cy="100" r="60" fill="none" stroke="#e5e7eb" stroke-width="20"/>
                                                <circle cx="100" cy="100" r="60" fill="none" stroke="#22c55e" stroke-width="20"
                                                        stroke-dasharray="94,283" stroke-linecap="round" transform="rotate(-90 100 100)"/>
                                                <circle cx="100" cy="100" r="60" fill="none" stroke="#ef4444" stroke-width="20"
                                                        stroke-dasharray="71,283" stroke-dashoffset="-94" stroke-linecap="round" transform="rotate(-90 100 100)"/>
                                                <circle cx="100" cy="100" r="60" fill="none" stroke="#3b82f6" stroke-width="20"
                                                        stroke-dasharray="118,283" stroke-dashoffset="-165" stroke-linecap="round" transform="rotate(-90 100 100)"/>
                                            </svg>
                                            <p class="text-muted small">Preview</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cash Flow -->
                    <div class="tab-pane fade" id="cashflow" role="tabpanel">
                        @php
                            $hasCashFlow = !empty($cashFlow['inflows']) || !empty($cashFlow['outflows']);
                            $totalIn = array_sum($cashFlow['inflows'] ?? []);
                            $totalOut = array_sum($cashFlow['outflows'] ?? []);
                        @endphp

                        @if($hasCashFlow && ($totalIn > 0 || $totalOut > 0))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card bg-success-lt border-success mb-3">
                                    <div class="card-header bg-transparent">
                                        <h5 class="card-title text-success mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M17 8l4 4l-4 4" />
                                                <path d="M14 12h7" />
                                                <path d="M3 12h7" />
                                                <path d="M6 8l-4 4l4 4" />
                                            </svg>
                                            Cash Inflows
                                        </h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-sm table-vcenter card-table">
                                            <tbody>
                                                @foreach($cashFlow['inflows'] ?? [] as $inflow => $amount)
                                                @if($amount > 0)
                                                <tr>
                                                    <td class="ps-3">{{ ucfirst($inflow) }}</td>
                                                    <td class="text-end text-success fw-bold pe-3">+{{ number_format($amount, 2) }}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                <tr class="bg-success text-white">
                                                    <td class="ps-3 fw-bold">Total Inflows</td>
                                                    <td class="text-end fw-bold pe-3">+{{ number_format($totalIn, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-danger-lt border-danger mb-3">
                                    <div class="card-header bg-transparent">
                                        <h5 class="card-title text-danger mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 8l-4 4l4 4" />
                                                <path d="M17 8l4 4l-4 4" />
                                                <path d="M3 12h7" />
                                                <path d="M14 12h7" />
                                            </svg>
                                            Cash Outflows
                                        </h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-sm table-vcenter card-table">
                                            <tbody>
                                                @foreach($cashFlow['outflows'] ?? [] as $outflow => $amount)
                                                @if($amount > 0)
                                                <tr>
                                                    <td class="ps-3">{{ ucfirst($outflow) }}</td>
                                                    <td class="text-end text-danger fw-bold pe-3">-{{ number_format($amount, 2) }}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                <tr class="bg-danger text-white">
                                                    <td class="ps-3 fw-bold">Total Outflows</td>
                                                    <td class="text-end fw-bold pe-3">-{{ number_format($totalOut, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light">
                            <div class="card-body d-flex justify-content-between align-items-center py-3">
                                <span class="fw-bold h5 mb-0">Net Cash Flow</span>
                                @php $netCash = $totalIn - $totalOut; @endphp
                                <span class="h3 mb-0 {{ $netCash >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $netCash >= 0 ? '+' : '' }}{{ number_format($netCash, 2) }}
                                </span>
                            </div>
                        </div>
                        @else
                        <div class="empty">
                            <div class="empty-img">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash-off" width="64" height="64" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M13 9h6a2 2 0 0 1 2 2v6m-2 2h-10m-2 -2v-6a2 2 0 0 1 2 -2" />
                                    <path d="M12.582 12.59l-6.583 6.59a2 2 0 0 1 -2.827 -2.828l6.582 -6.59" />
                                    <path d="M17 9v-1a2 2 0 0 0 -2 -2h-6m-4 0l-2.5 2.5" />
                                    <path d="M3 3l18 18" />
                                </svg>
                            </div>
                            <p class="empty-title h3">No Cash Flow Data</p>
                            <p class="empty-subtitle text-muted">Record transactions to track your cash movements</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Insights & Recommendations -->
        <div class="row row-deck row-cards">
            <!-- AI Recommendations -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 21h6v-9a1 1 0 0 0 -1 -1h-4a1 1 0 0 0 -1 1v9z" />
                                <path d="M12 3l0 9" />
                                <path d="M12 3l3 3l-3 3" />
                                <path d="M12 3l-3 3l3 3" />
                            </svg>
                            Smart Recommendations
                        </h3>
                    </div>
                    <div class="card-body">
                        @forelse($recommendations ?? [] as $recommendation)
                            <div class="alert alert-info alert-important mb-2 py-2">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                            <path d="M12 9h.01" />
                                            <path d="M11 12h1v4h1" />
                                        </svg>
                                    </div>
                                    <div>{{ $recommendation->recommendation }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="empty">
                                <div class="empty-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bulb-off" width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 12h1" />
                                        <path d="M12 3v1" />
                                        <path d="M20 12h1" />
                                        <path d="M5.6 5.6l.7 .7" />
                                        <path d="M18.4 5.6l-.7 .7" />
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M12 21v-7" />
                                    </svg>
                                </div>
                                <p class="empty-subtitle text-muted">No recommendations available at this time.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Actionable Insights -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 9v4" />
                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                <path d="M12 16h.01" />
                            </svg>
                            Actionable Insights
                        </h3>
                    </div>
                    <div class="card-body">
                        @forelse($actionableInsights ?? [] as $insight)
                            <div class="alert alert-{{ $insight['status'] ?? 'info' }} mb-2 py-2">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong>{{ $insight['message'] }}</strong>
                                        <p class="mb-0 small text-muted mt-1">{{ $insight['details'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty">
                                <div class="empty-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-dots" width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 3v18h18" />
                                        <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M13 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M18 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M21 16m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    </svg>
                                </div>
                                <p class="empty-subtitle text-muted">No actionable insights available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* Premium Chart Empty States */
.chart-container {
    position: relative;
}

.chart-empty-state {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 0.5rem;
    border: 2px dashed #e2e8f0;
}

.chart-empty-state-small {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(248, 250, 252, 0.9);
    border-radius: 50%;
}

.placeholder-svg {
    width: 100%;
    height: auto;
    opacity: 0.6;
}

.donut-placeholder {
    width: 100px;
    height: 100px;
}

.chart-placeholder {
    width: 200px;
    height: 100px;
    margin: 0 auto;
}

/* Smooth animations */
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08);
}

/* Better table styling */
.table-vcenter td {
    vertical-align: middle;
}

/* Progress bars */
.progress-sm {
    height: 6px;
}

/* Avatar improvements */
.avatar-lg {
    width: 3rem;
    height: 3rem;
    font-size: 1.5rem;
}
</style>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const currency = '{{ auth()->user()->account->currency ?? "TZS" }}';

    // Common chart options
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    };

    // 1. Trend Chart (Line) - Always show, even with empty data
    const trendCtx = document.getElementById('chart-trend');
    if (trendCtx) {
        const hasData = {{ !empty($chartData) && count(array_filter($chartData)) > 0 ? 'true' : 'false' }};

        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
                datasets: [
                    {
                        label: 'Sales',
                        data: hasData ? {!! json_encode($chartData ?? []) !!} : [65, 78, 90, 81, 96, 105, 120],
                        borderColor: '#22c55e',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: hasData ? 4 : 0,
                        pointBackgroundColor: '#22c55e',
                        borderDash: hasData ? [] : [5, 5],
                        opacity: hasData ? 1 : 0.3
                    },
                    {
                        label: 'Expenses',
                        data: hasData ? {!! json_encode($expenseChartData ?? []) !!} : [45, 52, 48, 58, 62, 68, 72],
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.05)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: hasData ? 4 : 0,
                        pointBackgroundColor: '#ef4444',
                        borderDash: hasData ? [] : [5, 5],
                        opacity: hasData ? 1 : 0.3
                    }
                ]
            },
            options: {
                ...commonOptions,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return currency + ' ' + value.toLocaleString();
                            },
                            color: hasData ? '#64748b' : '#cbd5e1'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: hasData ? '#64748b' : '#cbd5e1'
                        }
                    }
                }
            }
        });
    }

    // 2. Stock Status Donut - Always show
    const stockCtx = document.getElementById('chart-stock-donut');
    if (stockCtx) {
        const hasStockData = {{ (($totalAvailableStock ?? 0) + ($lowStockItems ?? 0) + ($outOfStockItems ?? 0)) > 0 ? 'true' : 'false' }};

        new Chart(stockCtx, {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Low Stock', 'Out of Stock'],
                datasets: [{
                    data: hasStockData ? [
                        {{ $totalAvailableStock ?? 0 }},
                        {{ $lowStockItems ?? 0 }},
                        {{ $outOfStockItems ?? 0 }}
                    ] : [75, 15, 10],
                    backgroundColor: [
                        hasStockData ? '#22c55e' : '#dcfce7',
                        hasStockData ? '#f59e0b' : '#fef3c7',
                        hasStockData ? '#ef4444' : '#fee2e2'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                ...commonOptions,
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: hasStockData,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.raw / total) * 100).toFixed(1) : 0;
                                return context.label + ': ' + context.raw + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // 3. Profit Distribution Donut - Always show
    const profitCtx = document.getElementById('chart-profit-donut');
    if (profitCtx) {
        const hasFinancialData = {{ (($profit ?? 0) + ($totalExpenses ?? 0) + ($incomeStatement['cogs'] ?? 0)) > 0 ? 'true' : 'false' }};

        new Chart(profitCtx, {
            type: 'doughnut',
            data: {
                labels: ['Net Profit', 'Expenses', 'COGS'],
                datasets: [{
                    data: hasFinancialData ? [
                        {{ $profit ?? 0 }},
                        {{ $totalExpenses ?? 0 }},
                        {{ $incomeStatement['cogs'] ?? 0 }}
                    ] : [35, 25, 40],
                    backgroundColor: [
                        hasFinancialData ? '#22c55e' : '#dcfce7',
                        hasFinancialData ? '#ef4444' : '#fee2e2',
                        hasFinancialData ? '#3b82f6' : '#dbeafe'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                ...commonOptions,
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: hasFinancialData
                    }
                }
            }
        });
    }

    // 4. Income Breakdown Donut - Always show
    const incomeCtx = document.getElementById('chart-income-breakdown');
    if (incomeCtx) {
        const hasIncomeData = {{ (($incomeStatement['netIncome'] ?? 0) + ($incomeStatement['expenses'] ?? 0) + ($incomeStatement['cogs'] ?? 0)) > 0 ? 'true' : 'false' }};

        new Chart(incomeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Net Income', 'Operating Expenses', 'COGS'],
                datasets: [{
                    data: hasIncomeData ? [
                        {{ $incomeStatement['netIncome'] ?? 0 }},
                        {{ $incomeStatement['expenses'] ?? 0 }},
                        {{ $incomeStatement['cogs'] ?? 0 }}
                    ] : [30, 25, 45],
                    backgroundColor: [
                        hasIncomeData ? '#1a2744' : '#e2e8f0',
                        hasIncomeData ? '#ef4444' : '#fee2e2',
                        hasIncomeData ? '#3b82f6' : '#dbeafe'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        display: hasIncomeData,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15
                        }
                    },
                    tooltip: {
                        enabled: hasIncomeData
                    }
                }
            }
        });
    }
});
</script>
@endsection

@extends('layouts.tabler')

@section('title', 'Budget Manager')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    {{ __('Financial Planning') }}
                </div>
                <h2 class="page-title">
                    {{ __('Budget Manager') }}
                </h2>
                <div class="text-muted mt-1">
                    {{ __('Track, manage, and optimize your spending') }}
                </div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M18.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M7.5 16.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M18.5 16.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M7 7h10v10h-10z" />
                        </svg>
                        Categories
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBudgetModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        New Budget
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        @php
            $totalBudget = $budgets->sum('amount');
            $totalSpent = $expenses->sum('amount');
            $totalRemaining = $totalBudget - $totalSpent;
            $percentageUsed = $totalBudget > 0 ? ($totalSpent / $totalBudget) * 100 : 0;
            $currency = auth()->user()->account->currency ?? 'TZS';
        @endphp

        <!-- Summary Cards -->
        <div class="row row-deck row-cards mb-4">
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="subheader text-primary">Total Budget</div>
                            <div class="ms-auto">
                                <span class="bg-primary text-white avatar avatar-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                        <path d="M12 6v2m0 8v2" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="h1 mb-0 text-primary">{{ $currency }} {{ number_format($totalBudget, 2) }}</div>
                        <div class="text-muted small mt-1">Allocated across {{ $budgets->count() }} categories</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="subheader text-danger">Total Spent</div>
                            <div class="ms-auto">
                                <span class="bg-danger text-white avatar avatar-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M9 12l6 0" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="h1 mb-0 text-danger">{{ $currency }} {{ number_format($totalSpent, 2) }}</div>
                        <div class="text-muted small mt-1">{{ round($percentageUsed, 1) }}% of total budget</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="subheader text-success">Remaining</div>
                            <div class="ms-auto">
                                <span class="bg-success text-white avatar avatar-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 2l3.09 6.26l6.91 1l-5 4.87l1.18 6.88l-6.18 -3.25l-6.18 3.25l1.18 -6.88l-5 -4.87l6.91 -1z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="h1 mb-0 text-success">{{ $currency }} {{ number_format($totalRemaining, 2) }}</div>
                        <div class="text-muted small mt-1">{{ round(100 - $percentageUsed, 1) }}% available</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row row-deck row-cards mb-4">
            <!-- Budget Utilization -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                <path d="M4 20l14 0" />
                            </svg>
                            Budget Utilization
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Overall Progress -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-medium">Overall Budget Usage</span>
                                <span class="badge {{ $percentageUsed > 90 ? 'bg-danger' : ($percentageUsed > 75 ? 'bg-warning' : 'bg-success') }}">
                                    {{ round($percentageUsed, 1) }}%
                                </span>
                            </div>
                            <div class="progress progress-lg">
                                <div class="progress-bar {{ $percentageUsed > 90 ? 'bg-danger' : ($percentageUsed > 75 ? 'bg-warning' : 'bg-success') }}"
                                     role="progressbar"
                                     style="width: {{ min($percentageUsed, 100) }}%;"
                                     aria-valuenow="{{ $percentageUsed }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between text-muted small mt-1">
                                <span>0%</span>
                                <span>50%</span>
                                <span>100%</span>
                            </div>
                        </div>

                        <!-- Category Breakdown -->
                        <h4 class="card-title fs-6 mb-3">By Category</h4>
                        @forelse($budgets as $budget)
                            @php
                                $budgetPct = $budget->amount > 0 ? ($budget->spent / $budget->amount) * 100 : 0;
                                $budgetStatus = $budgetPct > 100 ? 'danger' : ($budgetPct > 80 ? 'warning' : 'success');
                            @endphp
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-xs bg-{{ $budgetStatus }}-lt text-{{ $budgetStatus }} me-2">
                                            {{ strtoupper(substr($budget->category->name, 0, 1)) }}
                                        </span>
                                        <span class="fw-medium">{{ $budget->category->name }}</span>
                                    </div>
                                    <div class="text-end">
                                        <span class="small text-muted">{{ $currency }} {{ number_format($budget->spent) }} / {{ number_format($budget->amount) }}</span>
                                    </div>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-{{ $budgetStatus }}"
                                         role="progressbar"
                                         style="width: {{ min($budgetPct, 100) }}%;"
                                         aria-valuenow="{{ $budgetPct }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between text-muted small mt-1">
                                    <span>{{ round($budgetPct, 1) }}% used</span>
                                    <span class="{{ $budget->amount - $budget->spent < 0 ? 'text-danger' : 'text-success' }}">
                                        {{ $budget->amount - $budget->spent < 0 ? '-' : '' }}{{ $currency }} {{ number_format(abs($budget->amount - $budget->spent)) }} {{ $budget->amount - $budget->spent < 0 ? 'over' : 'left' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="empty">
                                <div class="empty-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie-off" width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M5 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M3 3l18 18" />
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    </svg>
                                </div>
                                <p class="empty-subtitle text-muted">No budgets created yet</p>
                                <div class="empty-action">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createBudgetModal">
                                        Create First Budget
                                    </button>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Growth Chart -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 3v18h18" />
                                <path d="M18 17v-7" />
                                <path d="M13 17v-11" />
                                <path d="M8 17v-4" />
                            </svg>
                            Spending Trend
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 250px; position: relative;">
                            <canvas id="growthChart"></canvas>

                            @if(empty($growthData['values']) || count(array_filter($growthData['values'])) === 0)
                            <div class="chart-empty-state">
                                <div class="text-center">
                                    <svg viewBox="0 0 200 120" class="placeholder-svg mb-2" style="width: 150px;">
                                        <path d="M10 100 Q50 80, 100 60 T190 20" fill="none" stroke="#e2e8f0" stroke-width="2" stroke-dasharray="5,5"/>
                                        <circle cx="10" cy="100" r="3" fill="#cbd5e1"/>
                                        <circle cx="100" cy="60" r="3" fill="#cbd5e1"/>
                                        <circle cx="190" cy="20" r="3" fill="#cbd5e1"/>
                                    </svg>
                                    <p class="text-muted small mb-0">No spending data yet</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card mt-3">
                    <div class="card-header py-2">
                        <h4 class="card-title fs-6 mb-0">Quick Stats</h4>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span class="text-muted">Active Budgets</span>
                            <span class="badge bg-primary rounded-pill">{{ $budgets->count() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span class="text-muted">Categories</span>
                            <span class="badge bg-info rounded-pill">{{ $budgetCategories->count() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span class="text-muted">Avg. Usage</span>
                            <span class="badge {{ $percentageUsed > 75 ? 'bg-warning' : 'bg-success' }} rounded-pill">{{ round($percentageUsed, 0) }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Budget Details Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-purple" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                        <path d="M4 8l16 0" />
                        <path d="M8 4l0 4" />
                    </svg>
                    Budget Details
                </h3>
                <div class="card-actions">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                        </span>
                        <input type="text" class="form-control form-control-sm" placeholder="Search budgets..." style="width: 200px;">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th class="w-1">#</th>
                            <th>Category</th>
                            <th class="text-end">Allocated</th>
                            <th class="text-end">Spent</th>
                            <th class="text-end">Remaining</th>
                            <th class="text-center">Usage</th>
                            <th class="text-center w-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($budgets as $index => $budget)
                            @php
                                $pct = $budget->amount > 0 ? ($budget->spent / $budget->amount) * 100 : 0;
                                $status = $pct > 100 ? 'danger' : ($pct > 80 ? 'warning' : 'success');
                                $remaining = $budget->amount - $budget->spent;
                            @endphp
                            <tr>
                                <td class="text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-xs bg-{{ $status }}-lt text-{{ $status }} me-2">
                                            {{ strtoupper(substr($budget->category->name, 0, 2)) }}
                                        </span>
                                        <div>
                                            <div class="font-weight-medium">{{ $budget->category->name }}</div>
                                            <div class="text-muted small">{{ $budget->start_date->format('M d') }} - {{ $budget->end_date->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end fw-medium">{{ $currency }} {{ number_format($budget->amount, 2) }}</td>
                                <td class="text-end text-danger">{{ $currency }} {{ number_format($budget->spent, 2) }}</td>
                                <td class="text-end {{ $remaining < 0 ? 'text-danger' : 'text-success' }} fw-bold">
                                    {{ $remaining < 0 ? '-' : '' }}{{ $currency }} {{ number_format(abs($remaining), 2) }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="progress progress-sm flex-grow-1 me-2" style="width: 60px;">
                                            <div class="progress-bar bg-{{ $status }}" style="width: {{ min($pct, 100) }}%"></div>
                                        </div>
                                        <span class="small text-muted">{{ round($pct, 0) }}%</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap justify-content-center">
                                        <button class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit text-primary" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-white btn-sm" data-bs-toggle="tooltip" title="Delete" onclick="return confirm('Delete this budget?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash text-danger" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="empty">
                                        <div class="empty-img">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet-off" width="64" height="64" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M17 8v-3a1 1 0 0 0 -1 -1h-8m-3.413 .584a2 2 0 0 0 1.413 3.416h2m4 0h6a1 1 0 0 1 1 1v3" />
                                                <path d="M19 19a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                                                <path d="M16 12h4v4m-4 0a2 2 0 0 1 -2 -2" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </div>
                                        <p class="empty-title h3">No budgets found</p>
                                        <p class="empty-subtitle text-muted">Create your first budget to start tracking expenses</p>
                                        <div class="empty-action">
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBudgetModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 5l0 14" />
                                                    <path d="M5 12l14 0" />
                                                </svg>
                                                Create Budget
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

<style>
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
    background: rgba(248, 250, 252, 0.9);
}
.placeholder-svg {
    opacity: 0.5;
}
.progress-lg {
    height: 1.5rem;
}
</style>

<!-- Manage Categories Modal -->
<div class="modal modal-blur fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M18.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M7.5 16.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M18.5 16.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M7 7h10v10h-10z" />
                    </svg>
                    Manage Categories
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="categoryForm" action="{{ route('budget-categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category-name" class="form-label">Category Name</label>
                        <input type="text" id="category-name" name="name" class="form-control" placeholder="e.g., Marketing, Operations" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Budget Modal -->
<div class="modal modal-blur fade" id="createBudgetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    Create New Budget
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('budgets.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="budget-category" class="form-label">Category</label>
                        <select id="budget-category" name="budget_category_id" class="form-select" required>
                            <option value="" selected disabled>Select category</option>
                            @foreach ($budgetCategories as $budgetCategory)
                                <option value="{{ $budgetCategory->id }}">{{ $budgetCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Allocated Amount ({{ $currency }})</label>
                        <input type="number" class="form-control" id="amount" name="amount" min="50" step="50" placeholder="0.00" required>
                        <small class="form-hint">Minimum amount is 50 {{ $currency }}</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Budget</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    const ctx = document.getElementById('growthChart');
    if (ctx) {
        @if(!empty($growthData['values']) && count(array_filter($growthData['values'])) > 0)
        const maxValue = Math.max(...{!! json_encode($growthData['values']) !!});
        const stepSize = Math.ceil(maxValue / 50) * 50;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($growthData['dates']) !!},
                datasets: [{
                    label: 'Budget Growth',
                    data: {!! json_encode($growthData['values']) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                },
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10 } }
                    },
                    y: {
                        beginAtZero: true,
                        min: 0,
                        ticks: {
                            stepSize: stepSize,
                            callback: function(value) {
                                return '{{ $currency }} ' + value.toLocaleString();
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    }
                }
            }
        });
        @else
        // Empty state chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'No Data',
                    data: [0, 0, 0, 0, 0, 0],
                    borderColor: '#e2e8f0',
                    borderDash: [5, 5],
                    borderWidth: 2,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { display: false },
                    y: { display: false }
                }
            }
        });
        @endif
    }
});
</script>
@endsection

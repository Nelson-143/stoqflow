{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('custom-users') }}"><i class="la la-user nav-icon"></i> {{ trans('Users') }}</a></li>
        <x-backpack::menu-item title="User Locations" icon="la la-map" :link="backpack_url('user/locations')" />
        <x-backpack::menu-item title="Financial Dashboard" icon="la la-chart-line" :link="backpack_url('financial-dashboard')" />

{{-- resources/views/vendor/backpack/ui/inc/menu_items.blade.php --}}
<li class="nav-item">
    <form method="POST" action="{{ backpack_url('toggle-maintenance') }}">
        @csrf
        <button type="submit" class="nav-link border-0 bg-transparent">
            <i class="la la-tools"></i>
            @if(file_exists(storage_path('framework/down')))
                <span class="text-success">Activate App</span>
            @else
                <span class="text-danger">Maintenance Mode</span>
            @endif
        </button>
    </form>
</li>


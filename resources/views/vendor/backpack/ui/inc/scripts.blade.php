@basset('https://unpkg.com/jquery@3.6.1/dist/jquery.min.js')
@basset('https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js')
@basset('https://unpkg.com/noty@3.2.0-beta-deprecated/lib/noty.min.js')
@basset('https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js')

@if (backpack_theme_config('scripts') && count(backpack_theme_config('scripts')))
    @foreach (backpack_theme_config('scripts') as $path)
        @if(is_array($path))
            @basset(...$path)
        @else
            @basset($path)
        @endif
    @endforeach
@endif

@if (backpack_theme_config('mix_scripts') && count(backpack_theme_config('mix_scripts')))
    @foreach (backpack_theme_config('mix_scripts') as $path => $manifest)
        <script type="text/javascript" src="{{ mix($path, $manifest) }}"></script>
    @endforeach
@endif

@if (backpack_theme_config('vite_scripts') && count(backpack_theme_config('vite_scripts')))
    @vite(backpack_theme_config('vite_scripts'))
@endif





@if(config('app.debug'))
    @include('crud::inc.ajax_error_frame')
@endif

@push('after_scripts')
    @basset(base_path('vendor/backpack/crud/src/resources/assets/js/common.js'))
@endpush
@push('after_scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check initial status
    function checkMaintenanceStatus() {
        fetch('{{ backpack_url('maintenance-status') }}')
            .then(response => response.json())
            .then(data => {
                const statusText = document.getElementById('maintenance-status-text');
                statusText.textContent = data.status === 'maintenance' 
                    ? 'Exit Maintenance' 
                    : 'Enter Maintenance';
            });
    }

    // Toggle handler
    document.getElementById('toggle-maintenance').addEventListener('click', function(e) {
        e.preventDefault();
        
        fetch('{{ backpack_url('toggle-maintenance') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            checkMaintenanceStatus();
            new Noty({
                type: 'success',
                text: 'Maintenance mode: ' + data.status,
                timeout: 3000
            }).show();
        });
    });

    // Initial check
    checkMaintenanceStatus();
});
</script>
@endpush
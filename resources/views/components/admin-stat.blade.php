@props(['color' => 'primary', 'label' => '', 'value' => 0, 'icon' => 'bi-info-circle'])

<div class="col-md-2 mb-3">
    <div class="card border-0 shadow-sm text-center">
        <div class="card-body">
            <i class="bi {{ $icon }} text-{{ $color }} display-5"></i>
            <h5 class="fw-bold mt-2">{{ $label }}</h5>
            <p class="display-6 text-{{ $color }}">{{ $value }}</p>
        </div>
    </div>
</div>

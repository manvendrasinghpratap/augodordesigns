<!--<a href="{{ $href }}" > @if($attributes->get('required'))<i class="fas fa-edit action-btn"></i> @else {{ $label }} @endif </a>-->


@props([
    'name',
    'label' => null,
    'href' => 'javascript:void(0)',
])

<a 
    href="{{ $href }}" 
    id="{{ $name }}" 
    {{ $attributes->class(['']) }}
>
    @if($attributes->has('required'))
        <i class="fas fa-edit action-btn"></i>
    @else
        {{ $label }}
    @endif
</a>



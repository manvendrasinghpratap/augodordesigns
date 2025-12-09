@props([
    'id',
    'label',
    'type' => 'text',
    'name',
    'value' => '',
    'placeholder' => '',
    'disabled' => false,
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">
        {{ $label ?? Str::title(str_replace('_', ' ', $name)) }}
            @if($attributes->get('required'))
                <span class="required error_{{ $name }}"> *</span>
           @endif
    </label>

    <input 
        id="{{ $id }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @disabled($disabled)
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')
        ]) }}
    >

    @error($name)
        <small class="invalid-feedback text-danger">{{ $message }}</small>
    @enderror
</div>

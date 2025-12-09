<div class="col-xl-4 col-md-6">
	<div class="form-group mb-3">
		<label for="{{ $name }}">{{ $label ?? Str::title(str_replace('_', ' ', $name)) }} 
		@if($attributes->get('required'))<span class="required error_{{ $name }}"> *</span>@endif
		</label>
		<input
        type="password"
        name="{{ $name }}"
		placeholder="{{ $label }}"
        value="{{ old($name, $value ?? '') }}"
		{{ $attributes->merge(['class' => 'form-control','id' => $name]) }}
        {{ $attributes }}
    >
	</div>
	@error('name')
		<div class = "required text-sm text-red-600 mt-1">{{ $message }}</div>
	@enderror
</div>


@props([
    'name',
    'label' => null,
    'value' => '',
    'type' => 'text',
])

<div class="col-xl-4 col-md-6">
    <div class="mb-3">
        <label for="{{ $name }}" class="form-label">
            {{ $label ?? Str::title(str_replace('_', ' ', $name)) }}
            @if($attributes->get('required'))
                <span class="text-danger">*</span>
            @endif
        </label>

        <input 
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $label ?? Str::title(str_replace('_', ' ', $name)) }}"
            {{ 
                $attributes->merge([
                    'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')
                ]) 
            }}
        >

        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


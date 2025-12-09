<div class="form-group center">
	<div class="">
		<button 
			type="submit" 
			{{ $attributes->merge(['class' => 'btn btn-primary']) }}
		>
			{{ $submitText ?? 'Submit' }}
		</button>

		<a href="{{ $url ?? 'javascript:void(0)' }}" class="btn btn-secondary">{{ $resetText ?? 'Reset' }}</a>
	</div>
</div>

@props(['label', 'type' => 'text', 'id', 'placeholder', 'value' => null, 'mt' => 'no', 'required' => false])

<div class="form-group">
    @if ($required)
        <label for="{{ $id }}" class="form-label">{{ $label ?? '' }} <small
                class="text-danger">*</small></label>
    @else
        <label for="{{ $id }}" class="form-label">{{ $label ?? '' }}</label>
    @endif
    <div class="input-group">
        <input type="{{ $type }}" name="{{ $id }}" value="{{ $value !== null ? old($id, $value) : '' }}"
            class="form-control @error($id) is-invalid @enderror" id="{{ $id }}"
            aria-describedby="{{ $id }}" placeholder="{{ $placeholder ?? '' }}" {{ $attributes }}>
    </div>
    @error($id)
        <div id="{{ $id }}" class="form-text text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

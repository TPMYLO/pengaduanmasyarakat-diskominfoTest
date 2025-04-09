@props(['label', 'id', 'options' => [], 'value' => null, 'colors'])

<div class="form-group">
    <label for="{{ $id }}" class="form-label">{{ $label ?? '' }}</label>
    @php
        $colorClass = $colors[$value] ?? 'text-default';
    @endphp
    <select class="form-select @error($id) is-invalid @enderror {{ $colorClass }}" aria-label="{{ $label ?? '' }}"
        name="{{ $id ?? '' }}" id="{{ $id ?? '' }}" {{ $attributes }}>
        <option selected disabled>Choose {{ $label ?? '' }}</option>
        @foreach ($options as $optionValue => $optionLabel)
            @php
                $colorClass = $colors[$optionValue] ?? 'text-default';
            @endphp
            <option value="{{ $optionValue }}" @if ($optionValue == $value) selected @endif
                class="{{ $colorClass }}">{{ $optionLabel }}</option>
        @endforeach
    </select>
    @error($id)
        <div id="{{ $id }}" class="form-text text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

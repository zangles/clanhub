@props([
    'name' => '',
    'value' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'prepend' => null,
    'prependIcon' => null,
    'prependAction' => null,
    'prependId' => null,
    'append' => null,
    'appendIcon' => null,
    'appendAction' => null,
    'appendId' => null,
    'class' => '',
    'size' => '', // sm, lg
    'help' => null,
    'showErrors' => true,
    'errors' => null
])

@php
    $errorBag = $errors ?? session()->get('errors', app('Illuminate\Support\MessageBag'));
    $hasError = $showErrors && $errorBag && $errorBag->has($name);

    $inputClass = 'form-control';

    if ($size) {
        $inputClass .= ' form-control-' . $size;
    }

    if ($hasError) {
        $inputClass .= ' parsley-error';
    }

    if ($class) {
        $inputClass .= ' ' . $class;
    }

    $inputId = $name . '_' . uniqid();
    $hasInputGroup = $prepend || $prependIcon || $append || $appendIcon;
@endphp

@if($hasInputGroup)
    <div class="input-group {{ $size ? 'input-group-' . $size : '' }}">
        @endif

        {{-- Prepend Section --}}
        @if($prepend || $prependIcon)
            <div class="input-group-prepend">
                @if($prependAction)
                    <button
                        class="btn btnInputGroupPrepend"
                        type="button"
                        @if($prependId) id="{{ $prependId }}" @endif
                        onclick="{{ $prependAction }}"
                    >
                        @if($prependIcon)
                            <i class="{{ $prependIcon }}"></i>
                        @endif
                        @if($prepend && $prependIcon) @endif
                        {{ $prepend }}
                    </button>
                @else
                    <span class="input-group-text">
                    @if($prependIcon)
                            <i class="{{ $prependIcon }}"></i>
                        @endif
                        @if($prepend && $prependIcon) @endif
                        {{ $prepend }}
                </span>
                @endif
            </div>
        @endif

        {{-- Input Field --}}
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $inputId }}"
            class="{{ $inputClass }}"
            value="{{ old($name, $value) }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            {{ $attributes->except(['class']) }}
        >

        {{-- Append Section --}}
        @if($append || $appendIcon)
            <div class="input-group-append">
                @if($appendAction)
                    <button
                        class="btn btnInputGroupAppend"
                        type="button"
                        @if($appendId) id="{{ $appendId }}" @endif
                        onclick="{{ $appendAction }}"
                    >
                        @if($appendIcon)
                            <i class="{{ $appendIcon }}"></i>
                        @endif
                        @if($append && $appendIcon) @endif
                        {{ $append }}
                    </button>
                @else
                    <span class="input-group-text">
                    @if($appendIcon)
                            <i class="{{ $appendIcon }}"></i>
                        @endif
                        @if($append && $appendIcon) @endif
                        {{ $append }}
                </span>
                @endif
            </div>
        @endif

        @if($hasInputGroup)
    </div>
@endif

{{-- Error Messages --}}
@if($hasError && $showErrors)
    <div class="invalid-feedback d-block">
        {{ $errors->first($name) }}
    </div>
@endif

{{-- Help Text --}}
@if($help)
    <small class="form-text text-muted">{{ $help }}</small>
@endif

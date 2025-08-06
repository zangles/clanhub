@props([
    'label',
    'config' => [],
    'layout' => 'default'
])

@php
    $layouts = [
        'default' => ['labelColClass' => 'col-sm-3', 'inputColClass' => 'col-sm-9'],
        'narrow' => ['labelColClass' => 'col-sm-4', 'inputColClass' => 'col-sm-8'],
        'wide' => ['labelColClass' => 'col-sm-2', 'inputColClass' => 'col-sm-10'],
    ];

    $finalConfig = array_merge($layouts[$layout] ?? $layouts['default'], $config);
    $labelColClass = $finalConfig['labelColClass'];
    $inputColClass = $finalConfig['inputColClass'];
@endphp

<div class="form-group row">
    <label class="control-label {{$labelColClass}}">{{$label}}</label>
    <div class="{{$inputColClass}}">
        {{$content}}
    </div>
</div>

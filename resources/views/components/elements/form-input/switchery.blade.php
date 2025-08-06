@props([
    'name' => '',
    'checked' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'class' => '',
    'size' => '', // small, large, empty = normal
])
@php
    $sizes = ['small', 'large'];
    if (!in_array($size, $sizes)) {
        $size = '';
    }
@endphp

<input type="checkbox"
       class="js-switch {{$class}}"
       id="{{$name}}"
       name="{{$name}}"
       @if($required) required @endif
       @if($checked) checked @endif
       @if($readonly) readonly @endif
/>
<script>
    var elem = document.querySelector('#{{$name}}');
    var switchery_{{$name}} = new Switchery(elem, {
        color: 'rgba(1,185,1,0.47)',
        jackColor: 'rgba(244, 244, 245, 0.7)',
        secondaryColor: 'rgb(4, 6, 32)',
        jackSecondaryColor: 'rgba(244, 244, 245, 0.7)',
        @if($size != '') size: '{{$size}}' @endif
    });
</script>


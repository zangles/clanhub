@props([
    'title' => '',
])

<section class="widget">
    <header>
        @if ($title != '')
            <h5>
                {{$title}}
            </h5>
        @endif
{{--        <div class="widget-controls">--}}
{{--            <a href="#"><i class="la la-cog"></i></a>--}}
{{--            <a href="#"><i class="la la-refresh"></i></a>--}}
{{--            <a href="#" data-widgster="close"><i class="la la-remove"></i></a>--}}
{{--        </div>--}}
    </header>
    <div class="widget-body">
        <legend></legend>
        {{ $content }}
    </div>
</section>

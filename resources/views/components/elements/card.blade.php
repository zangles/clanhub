<div class="card mb-xlg">
    <div class="card-body">
        @if ($dto?->title)
            <a href="#" class="fw-semi-bold {{$dto->title['class']}}">{{$dto->title['title']}}</a>
            <hr>
        @endif

{{--        <div class="d-flex justify-content-between mb-lg">--}}
        <div class="">
            {{ $content }}
        </div>

        @if ($dto?->buttons != null)
            <hr>
            <div class="" style="text-align: right">
            @foreach($dto->buttons as $button)
                <a href="{{$button['url']}}" class="btn  {{$button['class']}}">{{$button['title']}}</a>
            @endforeach
            </div>
        @endif
    </div>
</div>

<div class="alert">
    <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
    <span class="fw-normal">{{$dto->title}}</span> <br>
    <div class="progress progress-xs mt-2">
        <div class="progress-bar {{$dto->progressBarClass}}" role="progressbar" style="width: {{$dto->percentage}}%" aria-valuenow="{{$dto->percentage}}"
             aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <small>{{$dto->footerText}}</small>
</div>

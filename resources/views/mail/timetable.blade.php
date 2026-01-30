@component('mail::message')
<h2>Tunniplaan</h2>
    @foreach ($days as $day => $lessons)
        <strong>{{ $day }}</strong>
        <ul>
            @foreach ($lessons as $lesson)
                <li>{{$lesson['start']}}-{{$lesson['end']}} <strong>{{$lesson['name']}}</strong> {{$lesson['room']}}</li>
            @endforeach
        </ul>
    @endforeach
@endcomponent
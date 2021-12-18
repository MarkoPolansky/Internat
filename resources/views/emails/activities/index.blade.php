
@component('mail::message')
# Aktivita bola vybratá
@foreach($activities['availableActivities'] as $activity)
## {{$activity['name']}}
    {{$activities['starts_at']}} - {{$activities['ends_at']}}

@endforeach


    Radi ťa tam uvidíme,
    {{ config('app.name') }}
@endcomponent

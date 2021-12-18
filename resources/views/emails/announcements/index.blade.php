@component('mail::message')
     {{   $announcement->body  }}

     S pozdravom,
     {{ config('app.name') }}
@endcomponent


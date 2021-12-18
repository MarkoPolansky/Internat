@component('mail::message')
   # Ahoj {{$invite->name}}
    Toto je tvoja pozvánka do systému {{ config('app.name') }}

@component('mail::button', ['url' => route('invite.processing',$invite->token)])
            Dokončiť registráciu
@endcomponent

    S pozdravom,
    {{ config('app.name') }}

@component('mail::subcopy')
  Ak máš problém so stlačením "Dokončiť registráciu" tlačidlom,
   skopíruj a prilep URL adresu do svojho prehliadača:
   <a href=" {{route('invite.processing',$invite->token)}}">
       {{route('invite.processing',$invite->token)}}
   </a>

@endcomponent

@endcomponent


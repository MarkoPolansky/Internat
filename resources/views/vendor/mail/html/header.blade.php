<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{--@if (trim($slot) === 'Laravel')--}}
<img src="https://spse-po.sk/assets/images/logo.png" class="logo" alt="SPSE-Po Logo">
    <h1 >
        {{config('app.name')}}
    </h1>
{{--@else--}}
{{--{{ $slot }}--}}
{{--@endif--}}
</a>
</td>
</tr>

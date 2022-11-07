<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'ExtraJoss Tebak skor')
<img src="{{ asset('images/logo.png') }}" style="height: 75px;width: 75px;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

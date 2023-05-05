@props(['url'])
<tr>
<td class="header">
<a href="https://www.orchid-campus.com/" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="https://www.orchid-campus.com/assets/logo-orchid-campus_vert.jpg" class="logo" alt="">
@endif
</a>
</td>
</tr>

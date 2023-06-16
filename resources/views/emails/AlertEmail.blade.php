<h4>Alert Notification</h4>
<hr>
<p>Dear {{ $data['name'] }},</p>

<p>Please be alert on disposal date for the scheduled waste.</p>

<p>If the date is pass the due, further action will be taken.</p>

<p>Thank you. Have a nice day.</p>

<p>Sincererly,
    <br>{{ Auth::user()->name }}
</p>
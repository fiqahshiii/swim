<h4>Alert Notification</h4>
<hr>
<p>Dear {{ $data['fullname'] }},</p>

<p>You have been assign a scheduled waste to be disposed.</p>

<p>Any further inquires please let us know</p>

<p>Thank you. Have a nice day.</p>

<p>Sincererly,
    <br>{{ Auth::user()->name }}
</p>
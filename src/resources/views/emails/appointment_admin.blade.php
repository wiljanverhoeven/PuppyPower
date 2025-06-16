{{-- mail for admin appointment AppointmentConfirmation--}}
<p>Nieuwe afspraak ingepland:</p>

<ul>
    <li><strong>Naam:</strong> {{ $name }}</li>
    <li><strong>Telefoon:</strong> {{ $phone }}</li>
    <li><strong>Datum:</strong> {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</li>
    <li><strong>Tijd:</strong> {{ \Carbon\Carbon::parse($time)->format('H:i') }}</li>
</ul>

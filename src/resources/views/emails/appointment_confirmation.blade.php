{{--Mail for appointment notification admin--}}
<p>Beste {{ $appointment->name }},</p>

<p>Bedankt voor het inplannen van je Kennismaakgesprek.</p>

<P>Deze afspraak zal zich plaats vinden op:</P>
<p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}<br></p>
<p>Om:</p>
<p><strong>Tijd:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</p>

<p>Met vriendelijke groet,<br>Puppy Power Academy</p>

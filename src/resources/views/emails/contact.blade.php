<h2>Nieuw bericht via het contactformulier</h2>
<p><strong>Naam:</strong> {{ $data['name'] }} {{ $data['lastname'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Telefoon:</strong> {{ $data['phone'] ?? 'Geen nummer opgegeven' }}</p>
<p><strong>Onderwerp:</strong> {{ $data['subject'] }}</p>
<p><strong>Bericht:</strong></p>
<p>{{ $data['message'] }}</p>
<h1>Phones</h1>
@foreach($phones as $phone)
<p>Numero: {{$phone->number}}</p>
<p>Modello: {{$phone->model}}</p>
<p>Proprietario: {{$phone->user_id}}</p>
<br>
@endforeach
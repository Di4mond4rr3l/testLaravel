@foreach($users as $user)
<h3>{{$user->name}}</h3>
<p>Ruoli: 
    @foreach($user->roles as $role)
    {{$role->name}},
    @endforeach
</p>
<p>Telefono: {{$user->phone}}</p>
<p>Email: {{$user->email}}</p>
@endforeach

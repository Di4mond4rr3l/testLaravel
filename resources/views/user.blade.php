<form action="/users/{{$user->id}}" method="POST">
    
    @csrf
    @method('DELETE')
    <h3>{{$user->name}}</h3>
    <img src="{{asset('storage/'.$user->images)}}" alt="{{asset('storage/'.$user->images)}}">
    <p>Ruoli: 
        @foreach($user->roles as $role)
        {{$role->name}},
        @endforeach
    </p>
    <p>Telefono: {{$user->phone}}</p>
    <p>E-mail: {{$user->email}}</p>
    <input type="submit" value="Delete">

</form>
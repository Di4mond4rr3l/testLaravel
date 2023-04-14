<h1>Posts</h1>
@foreach($posts as $post)
<p>{{$post->title}}:</p>
<p>{{$post->body}}</p>
<p>By: {{$post->user->name}}</p>
<br>
@endforeach
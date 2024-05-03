<h2>{{$post->id}}</h2>

<div>
    <h3>{{$post->title}} </h3>
    <p>{{$post->content}} </p>
    <a href="{{route('posts.edit', [$post->id])}}">Изменить</a>
</div>

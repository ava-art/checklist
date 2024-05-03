<x-layout.main>

    
    <h2 class="text-4xl">Hello </h2>
    <hr>
    <a href="/posts/create">Создать пост</a>
    <hr>
    <ul>
        @foreach ($posts as $post)
        <li>номер статьи {{$post->id}}, с заголовком {{$post->title}} 
            <a href="{{route('posts.show', [$post->id])}}">показать больше</a> 
            <a href="/posts/{{$post->id}}/edit">изменить</a> 
        </li>
        @endforeach
    </ul>
    
</x-layout.main>
  
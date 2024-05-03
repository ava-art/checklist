<h2>Изменение поста</h2>

<form style="display: flex; max-width:600px; flex-direction:column;" method="post" action="{{route('posts.update', [$post->id])}}">
    @csrf
    @method('PUT')
    
    <x-input name="title" title="{{$post->title}}" />
    
    <textarea name="content" placeholder="Текст">{{$post->content}}</textarea>
    @error('content')
    <div style="color: red" >{{$message}}</div>
    @enderror
   
    <button>отправить</button>
</form>

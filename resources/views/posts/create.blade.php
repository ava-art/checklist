<h2>Создание поста</h2>

<form style="display: flex; max-width:600px; flex-direction:column;" method="post" action="/posts">
    @csrf
    <input type="text" name="title" placeholder="Заголовок">
    <textarea name="content" placeholder="Текст"></textarea>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <hr>
    <button>отправить</button>
</form>

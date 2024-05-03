@props([
    'title',
    'name',
    'defaultValue' => '',

])


<input type="text" name="{{$name}}" value="{{ $title }}" placeholder="Заголовок">
@error($name)
    <div style="color: red">{{ $message }}</div>
@enderror

@props(['name','for' => 'id'])

<label class="block mb-2 uppercase font-bold text-xs text-gray-700"
       for="{{$for}}"
>
    {{ucwords($name)}}
</label>

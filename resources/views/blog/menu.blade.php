@php
$categories = App\BlogCategory::all();
@endphp

<div class="card">
    <div class="card-header">
        Categories
    </div>
    <div class="card-body">
        @foreach($categories as $category)                          
            @if($category->postCount())
                <a href="/posts/category/{{$category->id}}">
                    {{$category->title}}
                </a> <br>
            @endif 
        @endforeach
    </div>
</div>
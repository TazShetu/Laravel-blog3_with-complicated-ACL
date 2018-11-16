@if(isset($catName))
    <div class="alert alert-info text-center">
        <p>Category: <strong>{{$catName}}</strong></p>
    </div>
@endif

@if(isset($userName))
    <div class="alert alert-info text-center">
        <p>All Posts from user: <strong>{{$userName}}</strong></p>
    </div>
@endif

@if(isset($tagName))
    <div class="alert alert-info text-center">
        <p>All Posts with Tag: <strong>{{$tagName}}</strong></p>
    </div>
@endif

@if($a = request('sp'))
    <div class="alert alert-info text-center">
        <p>Search results for: <strong>{{$a}}</strong></p>
    </div>
@endif
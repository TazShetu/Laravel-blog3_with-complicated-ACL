@extends('layouts.main')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post-item post-detail">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="post-item-image">
                        <img src="{{asset($p->image)}}" alt="Image error" height="400">
                    </div>
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{$p->title}}</h1>

                            <div class="post-meta no-border" id="ttt">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{route('author', ['name' => $p->user->slug])}}">{{$p->user->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{$p->updated_at->diffforHumans()}}</time></li>
                                    <li><i class="fa fa-comments"></i><a href="{{route('category', ['slug' => $p->category->slug])}}">{{$p->category->title}}</a></li>
                                    <li><i class="fa fa-tag"></i>
                                        @foreach($p->tags as $t)
                                            <a href="{{route('tag', ['slug' => $t->slug])}}">{{$t->name}}&nbsp;</a>
                                        @endforeach
                                    </li>
                                    <?php $cc = $p->comments->count() ?>
                                    <li><i class="fa fa-comments"></i><a href="#post-comment">{{$cc}} {{ str_plural('Comment', $cc) }}</a></li>
                                </ul>
                            </div>
{{--                            {!! Markdown::convertToHtml(e($p->body)) !!}--}}
                            {!! $p->body_html !!}
                            {{--here we r using attribute--}}
                        </div>
                    </div>
                </article>

                <article class="post-author padding-10">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img alt="Image error" src="https://picsum.photos/200/300?image=433" class="media-object" height="150">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{route('author', ['name' => $p->user->slug])}}">{{$p->user->name}}</a></h4>
                            <div class="post-author-count">
                                <a href="#">
                                    <i class="fa fa-clone"></i>
                                    <?php $postCount = $p->user->posts->count() ?>
                                    {{ $postCount }} {{ str_plural('post', $postCount) }}
                                </a>
                            </div>
{{--                            <p>{{$p->user->bio}}</p>     need to use markdown--}}
                            {!! Markdown::convertToHtml(e($p->user->bio)) !!}
                        </div>
                    </div>
                </article>

                @include('includes.comments')

            </div>

            @include('includes.sidebar')

        </div>
    </div>

@stop

@section('script')
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@stop
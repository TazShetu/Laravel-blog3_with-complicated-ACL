@extends('layouts.main')
 @section('content')

     <div class="container">
         <div class="row">
             <div class="col-md-8">
                @if($posts->count() == 0)
                    <div class="alert alert-warning text-center">
                        <p>No Post Found</p>
                    </div>
                @else

                    @include('includes.Balert')

                    @foreach($posts as $p)
                         <article class="post-item">
                             <div class="post-item-image">
                                 <a href="{{route('post.show', ['slug' => $p->slug])}}">
                                     <img src="{{asset($p->image)}}" alt="Image error" height="400">
                                 </a>
                             </div>
                             <div class="post-item-body">
                                 <div class="padding-10">
                                     <h2><a href="{{route('post.show', ['slug' => $p->slug])}}">{{$p->title}}</a></h2>
                                     {{--<p>{{$p->excerpt}}</p>--}}
                                     <p>{!! Markdown::convertToHtml(e($p->excerpt)) !!}</p>
                                     <a href="{{route('post.show', ['slug' => $p->slug])}}" class="btn btn-link">Continue Reading &raquo;</a>
                                 </div>

                                 <div class="post-meta padding-10 clearfix">
                                     <div class="pull-left">
                                         <ul class="post-meta-group">
                                             <li><i class="fa fa-user"></i><a href="{{route('author', ['name' => $p->user->slug])}}">{{$p->user->name}}</a></li>
                                             <li><i class="fa fa-clock-o"></i><time>{{$p->updated_at->diffforHumans()}}</time></li>
                                             <li><i class="fa fa-folder"></i><a href="{{route('category', ['slug' => $p->category->slug])}}"> {{$p->category->title}}</a></li>
                                             <li><i class="fa fa-tag"></i>
                                                 @foreach($p->tags as $t)
                                                     <a href="{{route('tag', ['slug' => $t->slug])}}">{{$t->name}}&nbsp;</a>
                                                 @endforeach
                                             </li>
                                             <?php $cc = $p->comments->count() ?>
                                             <li><i class="fa fa-comments"></i><a href="{{route('post.show', ['slug' => $p->slug])}}#post-comment">{{$cc}} {{ str_plural('Comment', $cc) }}</a></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </article>
                    @endforeach
                 @endif

                <nav class="text-center">
                     {{--<ul class="pager">--}}
                         {{--<li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Newer</a></li>--}}
                         {{--<li class="next"><a href="#">Older <span aria-hidden="true">&rarr;</span></a></li>--}}
                     {{--</ul>--}}
                    {{$posts->appends(request()->only(['sp']))->links()}}
                </nav>
             </div>

             @include('includes.sidebar')

         </div>
     </div>

 @stop
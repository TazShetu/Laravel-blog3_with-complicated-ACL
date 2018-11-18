@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                All Comments
            </h1>
            <ol class="breadcrumb pull-right">
                <li>
                    <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{route('index')}}">Blog</a>
                </li>
                <li class="active">All Comments</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        {{--<div class="box-header">--}}
                            {{--<div class="pull-left">--}}
                                {{--<a href="{{route('post.create')}}" class="btn btn-primary">Create new Post</a>--}}
                            {{--</div>--}}
                            {{--<div class="pull-right" style="padding: 7px 0;">--}}
                                {{--<a href="{{route('post.trashed')}}"><i class="fa fa-trash"></i> Trashed Post</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                            @if($comments->count() == 0)
                                <div class="alert alert-danger">
                                    <strong>No Comment to Show</strong>
                                </div>
                            @else
                                <table class="table table-bordered table-condesed">
                                    <thead>
                                    <tr>
                                        <th width="80">Action</th>
                                        <th>ID</th>
                                        <th>Content</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comments as $c)
                                            <tr>
                                                <td width="80">
                                                    @role(['admin'])
                                                        <a href="{{route('comment.delete', ['id' => $c->id])}}" title="Delete" class="btn btn-xs btn-danger delete-row">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    @endrole
                                                </td>
                                                <td>{{$c->id}}</td>
                                                {{--<td>{{$c->body}}</td>--}}
                                                {{--{!! Markdown::convertToHtml(e($p->user->bio)) !!}--}}
                                                <td>{!! Markdown::convertToHtml(e($c->body)) !!}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer  clearfix">
                            <div class="pull-left">
                                {{$comments->links()}}
                            </div>
                            {{--shows total posts in current page--}}
                            {{--to see total post no, we need to pass that $ from controller--}}
                            <div class="pull-right">
                                <?php $cc = $comments->count() ?>
                                <small>{{$cc}} {{str_plural('Comment', $cc)}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
@endsection


{{--we can edit the given pagination file--}}   {{--OR--}}
{{--use javascript to change class--}}
@section('script')

    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');
    </script>

@stop
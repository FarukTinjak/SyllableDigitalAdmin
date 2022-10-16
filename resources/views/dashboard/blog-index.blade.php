@extends('dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Blog posts</li>
@endsection

@section('title')
    Blog posts
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('dashboard.blog.create')}}" class="btn btn-success mb-2"><i class="fa fa-plus mr-1"></i> Create Post</a>

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Photo</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
@foreach($posts as $post)
                            <tr>
                                <td class="text-center">
                                @if($post->thumbnail_path !== null && file_exists(public_path($post->thumbnail_path)))
                                    <img src="{{asset($post->thumbnail_path)}}" style="max-width: 150px; max-height: 150px;" alt="">
                                @else
                                No photo
                                @endif
                                </td>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/blog/post/{{$post->id}}/{{$post->slug}}">{{$post->slug}}</a></td>
                                    <td>{{$post->created_at}}</td>
                                <td>
                                    <a href="{{route('dashboard.blog.edit', ['id' => $post->id])}}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Edit</a>
                                    <a href="{{route('dashboard.blog.delete', ['id' => $post->id])}}" onclick="return confirm('Are you sure you want to delete this record?');" class="btn btn-danger" ><i class="fa fa-trash-alt"></i> Delete</a>
                                </td>
                            </tr>
@endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

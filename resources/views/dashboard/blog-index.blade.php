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
               {{-- <div class="card-header">
                    <h3 class="card-title">DataTable with minimal features & hover style</h3>
                </div>--}}
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Photo</th>
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
                                @if($post->thumbnail_path !== null)
                                    <img src="{{asset('uploads/'.$post->thumbnail_path)}}" style="max-width: 150px; max-height: 150px;">
                                @else
                                No photo
                                @endif
                                </td>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/blog/{{$post->slug}}">{{$post->slug}}</a></td>
                                    <td>{{$post->created_at}}</td>
                                <td>
                                    <a href="" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Edit</a>
                                    <a href="" class="btn btn-danger" ><i class="fa fa-trash-alt"></i> Delete</a>
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

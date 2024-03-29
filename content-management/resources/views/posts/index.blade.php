@extends('layouts.app')


@section('content')

    <div class="d-flex justify-content-end">
        <a href="{{route('posts.create')}}" class="btn btn-success mb-2" >
            Add Post
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            Posts
        </div>

        <div class="card-body">
           @if($posts->count()>0)

                <table class="table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{URL::asset('storage/'.$post->image)}}"
                                     width="120px" height="60px" class="img-fluid">

                            </td>
                            <td>{{$post->title}}</td>

                            <td>{{$post->category->name}}</td>
                                @if($post->trashed())
                                <td>
                                    <form action="{{route('restore-post',$post->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm"> Restore</button>
                                    </form>
                                </td>
                                    @else

                                <td>

                                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm"> Edit</a>
                                </td>
                                @endif


                            <td>
                                <form method="post" action="{{route('posts.destroy',$post->id)}}">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">

                                        {{$post->trashed()? 'Delete':'Trash'}}</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
           @else
            <h3 class="text-center">No Posts Yet</h3>
            @endif
        </div>
    </div>
@endsection
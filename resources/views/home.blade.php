@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <!-- <div class="card-header">Dashboard</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div><a href="{{ url('/post') }}"><span class="btn btn-primary btn-lg mb-3">画像登録</span></a></div>

                    <div class="col_3">
                    @foreach($posts as $post)
                    @if( Auth::user()->id  == $post->user_id )
                    <div>
                    <a href="/post/{{$post->id}}">
                    <img src ="/{{ str_replace('public/', 'storage/', $post->image_url) }}" class="img-arrange">
                    </a>
                    </div>
                    @endif
                    @endforeach
                    </div>


                    <div class="d-flex justify-content-center mt-3">
                      {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

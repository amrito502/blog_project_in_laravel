@extends('client_master')
@section('client_content')
    <div class="main_home mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row mb-5">
                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="card">
                                    <a href="{{ url('detail/'.$post->id) }}"><img
                                            src="{{ asset('images/thumb/' . $post->thumb) }}"
                                            style="width: 100%; height:160px" alt="thumb"></a>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ url('detail/'.$post->id) }}">{{ $post->title }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-danger">No Post Found!</p>
                        @endforelse
                    </div>
                    {{-- =======pagination===== --}}
                    {{ $posts->links() }}
                </div>
                <div class="col-md-3">
                    {{-- ===search==== --}}
                    <div class="card">
                        <h5 class="card-header">Search</h5>
                        <div class="card-body">
                            <form action="{{ url('/') }}">
                                <div class="input-group mb-3">
                                    <input type="text" name="q" class="form-control" placeholder="Search Blog Post..">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary btn-dark text-light"
                                            type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- ====recent-post===== --}}
                    <div class="card mt-4">
                        <h5 class="card-header">Recent Post</h5>
                        <div class="list-group list-group-flush">
                            @if ($recent_post)
                                @foreach ($recent_post as $post)
                                <a href="" class="list-group-item">{{ $post->title }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{-- ====Popular-post===== --}}
                    <div class="card mt-4">
                        <h5 class="card-header">Popular Post</h5>
                        <div class="list-group list-group-flush">
                            <a href="" class="list-group-item">Post 1</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

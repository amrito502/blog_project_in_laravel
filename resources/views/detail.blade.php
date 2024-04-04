@extends('client_master')
@section('client_content')
    <div class="main_home mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header">
                            {{ $detail->title }}
                        </h5>
                        <img src="{{ asset('images/full_img/' . $detail->full_img) }}" class="card-img-top"
                            alt="{{ $detail->title }}">
                        <span class="float-right mt-2 mx-2"><strong>Total Views : </strong> <span
                                class="text-success">{{ $detail->views }}</span></span>
                        <div class="card-body">
                            {!! $detail->details !!}
                        </div>
                        <div class="card-footer">
                            In Category : <a href="">{{ $detail->category->title }}</a>
                        </div>
                    </div>
                    {{-- ======start-comments======== --}}
                    @if (Route::has('login'))
                        @auth
                            <div class="card mt-5">
                                <h5 class="card-title mt-3 mx-3">Add Comments : </h5>
                                <div class="card-body">
                                    @if (Session::has('message'))
                                        <p class="text-success">{{ session('message') }}</p>
                                    @endif
                                    <form action="{{ route('save.comment', $detail->id) }}" method="POST">
                                        @csrf
                                        <textarea name="comment" id="" cols="10" rows="5" placeholder="Write Comments.."
                                            class="form-control"></textarea>
                                        <button type="submit" class="btn btn-sm btn-success mt-3"
                                            style="float: right;">Comment</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="card p-3 my-5">
                                <p class="card-title">To Write a Comment. <br> Please Login Your Account <a
                                        href="{{ route('login') }}" class="btn btn-sm btn-success"><strong>Log in</strong></a>
                                </p>
                                @if (Route::has('register'))
                                    <div class="card-body">
                                        <p>If You have not a Account. <br> Please Create a new Account <a
                                                href="{{ route('register') }}" class="btn btn-sm btn-info">Register</a></p>
                                    </div>
                                @endif
                            </div>
                        @endauth
                    @endif

                    {{-- =======fetch-comment======== --}}
                    <div class="card my-4">
                        <h5 class="card-header">Comments : <span
                                class="text-light bg-success p-2 badge_count">{{ count($detail->comments) }}</span></h5>
                        <div class="card-body">
                            @if ($detail->comments)
                                @foreach ($detail->comments as $comment)
                                    <blockquote class="blockquote">
                                        <p class="mb">{{ $comment->comment }}</p>
                                        <footer class="blockquote-footer">Username:</footer>
                                    </blockquote>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{-- ======end-comments======== --}}
                </div>

                <div class="col-md-3">
                    {{-- ===search==== --}}
                    <div class="card">
                        <h5 class="card-header">Search</h5>
                        <div class="card-body">
                            <form action="{{ url('/') }}">
                                <div class="input-group mb-3">
                                    <input type="text" name="q" class="form-control"
                                        placeholder="Search Blog Post..">
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
                            @if ($popular_post)
                                @foreach ($popular_post as $post)
                                   <div class="card-body">
                                    <a href="" class="list-group-item">{{ $post->title }} </a>
                                    <span class="mx-2 mt-3"><strong>Views </strong>: {{ $post->views+1 }}</span>
                                   </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

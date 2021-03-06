@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">{{ __('YOUR LINKS') }}</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('status') }}
                        </div>
                    @endif




                    <h3 class="mb-5 mt-4">Welcome {{ $user->name }},<br> You have saved {{ $searchresult->count() }}
                        Links
                    </h3>

                    <form action="/home" method="get">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add New links') }}
                        </button>
                    </form>
                    <br>
                    <form action="{{ route('sharepost', [$user]) }}" method="get">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send All The Links to My Mail') }}
                        </button>
                    </form>
                    <br>
                    <form action="{{ route('downloadpdf', [$user->id]) }}" method="get">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Download As Pdf') }}
                        </button>
                    </form>
                    <br>


                    <div class="col-md-14">
                        <form action="/search" method="GET">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control"
                                    placeholder="ENTER THE TITLE HERE TO SEARCH">
                                <span class="input-group-prepend">
                                    <button type="submit"
                                        class="btn btn-primary ">{{ __('Search/Refresh') }}
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <br>
                    @if(Session::has('success'))
                        <div class="alert alert-success fade-message"
                            style="background-color: rgb(133, 146, 146);color:black">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            {!! Session::get('success') !!}

                        </div>
                        <script>
                            $(function () {
                                setTimeout(function () {
                                    $('.fade-message').slideUp();
                                }, 800);
                            });

                        </script>
                    @endif
                    @if(Session::has('mailsent'))
                        <div class="alert alert-success fade-mail-message"
                            style="background-color: rgb(133, 146, 146);color:black">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!! Session::get('mailsent') !!}

                        </div>
                        <script>
                            $(function () {
                                setTimeout(function () {
                                    $('.fade-mail-message').slideUp();
                                }, 800);
                            });

                        </script>

                    @endif


                    @if($searchresult->count()>0)
                        <div class="row">
                            @foreach($searchresult as $post)
                                <div class="col-sm-4" style="padding: 5px">

                                    <div class="card" id="linkdetails">
                                        <div class="card-body" style="padding: 8px">
                                            <div class="card-header">
                                                <h2>{{ $post->title }}</h2>
                                            </div>
                                            <a style="font-size: 20px">Description </a>{{ $post->description }}
                                            <br />
                                            <a style="font-size: 20px">Site Link </a>
                                            <a href="{{ $post->sitelink }}"
                                                target="_blank">{{ $post->sitelink }}</a>
                                            <br />
                                            <a style="font-size: 20px">Posted
                                                On
                                            </a>{{ $post->created_at->format('d/m/Y') }}
                                            <br />
                                            <div class="card-footer" style="background-color: inherit;padding:5px">

                                                <form
                                                    action="{{ route('deletelink', [$post->id]) }}"
                                                    method="get">
                                                    <button type="submit" class="btn btn-danger">
                                                        {{ __('Delete this Link') }}
                                                    </button>
                                                </form>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-success" role="alert" style="color:black">
                            No Such Links Found,<br>Please Check The Link You Want To Search ->

                            <a style="color: rgb(1, 51, 90);text-decoration:underline"
                                href="/showposts">{{ __('Refresh here!') }}
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


</div>
{{-- <div class="fixed-bottom">

    <div class="alert alert-success" style="margin-bottom: 0">
        <form action="/submitfeedback" method="GET">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>


            <div class="input-group">
                <label for="sitelink"
                    class="col-md-2 col-form-label text-md-right">{{ __('Feedback/Comments') }}</label>
<input type="text" name="feedback" class="form-control " placeholder="Please Share Your Valuable Feedback">
<span class="input-group-prepend">
    <button type="submit" class="btn btn-primary ">{{ __('Submit') }}
    </button>
</span>

</div>
</form>
</div>

</div> --}}
@endsection

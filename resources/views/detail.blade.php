@extends('layout')

@section('head')
<title>Ian工程師筆記</title>
@endsection

@section('bodyContent')

<div class="container max-w-5xl bg-white mx-auto shadow-md p-10 " style="min-height: 50vh">
    @foreach ($articles as $article)
    <a href="" class="px-2 text-sm rounded-sm  text-white bg-blue-500">{{$article->tag_name}}</a>
    <h2 class="mb-1 text-3xl font-medium">{{$article->title}}</h2>
    <p class="my-3 text-gray-400 font-light tracking-wider">{{date('Y-m-d H:i:s', strtotime($article->created_at))}}</p>
    <div class="content my-5" style="line-height: 2;
    letter-spacing: 1.2px;
    font-weight: 300;
    font-size: 1.3rem;">
        {!!$article->content!!}
    </div>
    @endforeach

</div>
@endsection


@section('script')
@endsection

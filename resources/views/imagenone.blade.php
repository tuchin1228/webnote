@extends('layout')

@section('head')
<title>Ian工程師筆記</title>
@endsection

@section('bodyContent')
<div class="container max-w-5xl bg-white mx-auto shadow-md p-10 " style="min-height: 50vh">
    {{-- {{print_r($images)}} --}}
    <div class="flex flex-wrap " style="border:1px solid #d8d8d8;border-radius:5px;padding:10px;">
        <div style="width: 100%;" class="flex justify-between items-center">
            <h2 style=" font-weight:600;font-size:1.8rem;">未發布圖片</h2>
            <form action="{{route('DeleteNotuse')}}" method="POST">
                @csrf
                <input type="text" name="type" value="1" hidden>
                <button type="submit"
                    class="rounded px-3 py-2 text-base bg-red-500 hover:bg-red-400 text-white font-bold">全部刪除</button>
            </form>
        </div>
        @foreach ($notitle_images as $image)
        <div class="" style=" width: 95%;max-width:150px;margin:10px 15px;">
            <p class="text-center">{{$image->date}}</p>
            <img src="storage/uploads/{{$image->filename}}" alt="">
        </div>
        @endforeach
    </div>
    <div class="mt-5 px-2 rounded" style="border:1px solid #d8d8d8;">
        <div style="width: 100%;" class="py-3 flex justify-between items-center">
            <h2 style=" font-weight:600;font-size:1.8rem;">未使用圖片</h2>
            <form action="{{route('DeleteNotuse')}}" method="POST">
                @csrf
                <input type="text" name="type" value="2" hidden>
                <button type="submit"
                    class="rounded px-3 py-2 text-base bg-red-500 hover:bg-red-400 text-white font-bold">全部刪除</button>
            </form>
        </div>
        @foreach ($hastitle_images as $image)
        <div class="" style="border-bottom:1px solid #d8d8d8;border-radius:5px;padding:10px;margin:10px 0;">
            <h3>{{$image->title}} - {{$image->created_at}}</h3>
            <img style="max-width: 200px" src="storage/uploads/{{$image->filename}}" alt="">
        </div>
        @endforeach
    </div>
</div>
@endsection


@section('script')
@endsection

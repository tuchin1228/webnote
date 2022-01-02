@extends('layout')

@section('head')
<title>訪客回饋 - Ian工程師筆記</title>
@endsection

@section('bodyContent')

<div class="container max-w-5xl bg-white mx-auto shadow-md p-5 md:p-10 " style="min-height: 50vh">
    <div class="my-3">
        @if($errors->any())
        @foreach ($errors->all() as $error)
        <p class="my-1 text-red-600 ">* {{ $error }}</p>
        @endforeach
        @endif
    </div>
    <form action="{{route('ContactPost')}}" method="POST">
        @csrf
        <div class="flex items-center mb-1">
            <label for="name" class="text-xl mr-2">暱稱：</label>
            <input type="text" name="name" id="name" value="{{old('name')}}"
                class=" border rounded border-gray-400 text-md p-1">
        </div>
        <label for="content" class="text-xl mr-2">內容：</label>
        <textarea name="content" id="content" placeholder="任何鼓勵或是問題回報都可以在此留言"
            class="block font-light border w-full p-1 " id="" cols="30" rows="10">{{old('content')}}</textarea>
        <div class="text-right">
            <button type="submit"
                class="text-xl px-1 my-1 rounded bg-red-500 hover:bg-red-400 text-white font-bold">送　出</button>
        </div>
    </form>
</div>
@endsection


@section('script')
@endsection

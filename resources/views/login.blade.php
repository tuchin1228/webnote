@extends('layout')

@section('head')
<title>管理員登入</title>


@endsection
@section('bodyContent')

<div class="container max-w-5xl bg-white mx-auto shadow-md p-10 " style="min-height: 50vh">
    <form action="{{route('LoginCheck')}}" method="POST" class="text-center">
        @csrf
        <h2 class="text-3xl font-bold my-3">管理員登入</h2>

        <label for="">帳號：<input type="text" name="account" class="border text-lg p-2 my-2"></label><br>
        <label for="">密碼：<input type="password" name="password" class="border text-lg p-2 my-2"></label><br>
        <button type="submit" class="py-1 px-3 text-white bg-blue-500 hover:bg-blue-400 rounded">登入</button>
    </form>
</div>

@endsection

@section('script')
@endsection

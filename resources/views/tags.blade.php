@extends('layout')

@section('head')
<title>標籤管理 - Ian前後端筆記</title>
<style>
    table {
        border-collapse: separate;
        border-spacing: 0;
        border-top: 1px solid rgb(221, 221, 221);
    }

    table tr td {
        padding: 15px 0;
        border-bottom: 1px solid rgb(221, 221, 221);
        border-right: 1px solid rgb(221, 221, 221);
    }

    table tr td:first-child {
        border-left: 1px solid rgb(221, 221, 221);
    }

</style>
@endsection



@section('bodyContent')

<div class="container max-w-5xl bg-white mx-auto shadow-md p-10 " style="min-height: 50vh">
    <form action="{{route('UpdateTagManage')}}" method="POST">
        @csrf
        <table class=" w-full">
            <tr>
                <td class="w-1/3 text-center">序號</td>
                <td class="w-1/3 text-center">標籤名稱</td>
                <td class="w-1/3 text-center">更新</td>
            </tr>
            @foreach ($tags as $key => $tag)
            <tr>
                <td class="text-center">{{$key+1}}</td>
                <td class="text-center">{{$tag->tag_name}}</td>
                <td class="text-center">
                    {{-- <input type="text" name="tagNew[{{$tag->id}}]" value="{{$tag->id}}"> --}}
                    <input type="text" class="border text-lg p-1" name="tagNew[{{$tag->id}}][]">
                </td>
            </tr>
            @endforeach
        </table>
        <div class="text-right">
            <button type="submit"
                class="text-xl p-1 bg-red-500 hover:bg-red-400 text-white font-bold my-2 rounded">送　出</button>
        </div>
    </form>
</div>
@endsection

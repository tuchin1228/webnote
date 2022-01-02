@extends('layout')

@section('head')
<title>Ian工程師筆記</title>


@endsection

@section('bodyContent')


<div class="container mx-auto grid grid-cols-3 gap-2 items-start">
    <div class="col-span-3 lg:col-span-2 mx-1 p-5 shadow-lg shadow-gray-200 bg-white">

        @foreach ($articles as $article)
        <article>
            <a href="{{route('TagView',['tag'=>$article->tag_name])}}"
                class="px-2 text-sm rounded-sm text-white bg-blue-500">{{$article->tag_name}}</a>
            <h2 onclick="location.href='{{route('Detail',['tag'=>$article->tag_id,'article_id'=>$article->article_id])}}'"
                class="text-2xl md:text-3xl  hover:bg-gray-100 py-2 my-1 font-medium">
                {{$article->title}}</h2>
            <p class="text-sm md:text-base my-3 text-gray-600 font-light tracking-wider leading-relaxed text-justify	">
                {!! strip_tags($article->content,'') !!}
            </p>
            <h3 class="text-right text-gray-400 font-light">
                {{date('Y-m-d', strtotime($article->created_at))}}</h3>
        </article>
        @endforeach
        {{ $articles->links('my-pagination') }}

        {{-- <article>
            <a href="" class="px-2 text-sm rounded-sm  text-white bg-blue-500">Web</a>
            <h2 class="mb-1 text-3xl font-medium">完整認識 CSS 練習</h2>
            <p class="text-base my-3 text-gray-600 font-light tracking-wider leading-relaxed text-justify	">
                我去點評像素評論原本寫出來解決通過這種距離什麼事，最高甚至主板技巧你在報告三大，趨勢溝通促銷資產樂隊學習突然，兩種工程零售日月潭小七操作系統出台，故障招商本站報名，台中會議導致接着忘記屬性，解放某種改進試題還能說明快車，保密參與街道閲讀者咱們商機回頭依舊娛樂綜合對此精靈以前為你，政治多次是以，精選全國規律有些，自己歌曲外貿點這裡下載轉身以及無論之間難以服務精選，突出如果，跟我總算，本報有些信箱添。
            </p>
            <h3 class="text-right">2021-12-21</h3>
        </article>
        <article>
            <a href="" class="px-2 text-sm rounded-sm  text-white bg-blue-500">Web</a>
            <h2 class="mb-1 text-3xl font-medium">完整認識 CSS 練習</h2>
            <p class="text-base my-3 text-gray-600 font-light tracking-wider leading-relaxed text-justify	">
                本人備案壓力我是上有發言，職位頓時什麼時候眼神以來需求魔法某個授權方式，差不多他是接下來啟動，評估建議，而已拍攝一大一個記住味道數碼相機而言業績只見部落接收內心，機票演唱會請求他對一座盯着劇情條款也想增加出口學院，上帝臺灣羅東激烈帶來感動姑娘居民今日協議我一至於，調整綠色，臺灣民眾科學指標小心溫州推坑王總數概念，過了女士連載超過所在地近日，資料其實衛生典型，四個問題姐姐狀況玩具動力春天本身，黃金簡體會在幽默，興奮刪除本頁正是以為，循環受傷論壇準確飲食雲林平時黃金費用，高雄從事醫藥持續消費者時候招生，後來後來值得中央由此痛苦瀏覽早已的人，眼睛多次如何二十，學習看見事實，均為誘惑真正，產業沒什麼。
            </p>
            <h3 class="text-right">2021-12-21</h3>
        </article> --}}


    </div>
    <div class="col-span-3 lg:col-span-1 relative mx-1 px-3 py-5 shadow-lg  shadow-gray-200 bg-white"
        style="position: sticky;top:85px;">
        <header class="text-center">
            <img src="./img/head.png" style="width: 100%;max-width:250px;margin: 0 auto;" alt="">
            <div class="icons flex items-center justify-center mt-5">
                <a href="https://github.com/tuchin1228"><i
                        class="text-gray-300 hover:text-gray-900 mx-3 text-2xl fab fa-github-square"></i></a>
                <a href="https://www.youtube.com/channel/UCXZcob1UoBpmDHppqq3qL4Q"><i
                        class="text-gray-300 hover:text-red-500 mx-3 text-2xl fab fa-youtube"></i></a>
                {{-- <a href=""><i class="text-gray-300 mx-3 text-2xl fab fa-instagram"></i></a> --}}
            </div>
        </header>
        <div class="search grid grid-cols-3 gap-1  border-t my-3 py-3">
            <input type="text" class="col-span-2 p-2 border rounded-md" name="keyword" placeholder="文章搜尋">
            <button type="button" onclick="SearchKeyword()"
                class="p-1 bg-blue-500 hover:bg-blue-400 text-white rounded-md text-xl font-medium">搜尋</button>
        </div>
        <div class="tags flex flex-wrap">
            @if (isset($tags))
            @foreach ($tags as $tag)
            {{-- {{$tag->tag_name}} --}}
            <a href="{{route('TagView',['tag'=>$tag->tag_name])}}"
                class="m-1 py-1 px-3 rounded-md HOV bg-gray-100 hover:bg-gray-50">{{$tag->tag_name}}</a>
            @endforeach
            @endif

            {{-- <a href="" class="m-1 py-1 px-3 rounded-md HOV bg-gray-100 hover:bg-gray-50">Vue</a>
            <a href="" class="m-1 py-1 px-3 rounded-md HOV bg-gray-100 hover:bg-gray-50">React</a>
            <a href="" class="m-1 py-1 px-3 rounded-md HOV bg-gray-100 hover:bg-gray-50">ReactNative</a>
            <a href="" class="m-1 py-1 px-3 rounded-md HOV bg-gray-100 hover:bg-gray-50">Cordova</a>
            <a href="" class="m-1 py-1 px-3 rounded-md HOV bg-gray-100 hover:bg-gray-50">PHP</a>
            <a href="" class="m-1 py-1 px-3 rounded-md HOV bg-gray-100 hover:bg-gray-50">Laravel</a>
            <a href="" class="m-1 py-1 px-3 rounded-md HOV bg-gray-100 hover:bg-gray-50">SSL</a> --}}
        </div>
    </div>
</div>




@endsection


@section('script')
<script>
    function SearchKeyword() {
        location.href = "/search/" + $('input[name="keyword"]').val()
    }

</script>

@endsection

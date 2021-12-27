@extends('layout')

@section('head')
<title>Ian工程師筆記</title>
<style>
    #imgModal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.9);
    }

    #imgModal .modal-content {
        margin: auto;
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #imgModal .modal-content {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: translate(-50%, -50%) scale(0)
        }

        to {
            -webkit-transform: translate(-50%, -50%) scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: translate(-50%, -50%) scale(0)
        }

        to {
            transform: translate(-50%, -50%) scale(1)
        }
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    @media only screen and (max-width: 700px) {
        #imgModal .modal-content {
            width: 100%;
        }
    }

</style>


@endsection

@section('bodyContent')

<div class="container max-w-5xl bg-white mx-auto shadow-md p-10 " style="min-height: 50vh">
    <div class="text-right">
        <button type="button"
            onclick="location.href='{{route('Edit',['tag'=>$article->tag,'article_id'=>$article->article_id])}}'"
            class="text-xl bg-blue-500 hover:bg-blue-400 text-white font-bold py-1 px-3 rounded">編輯</button>
        <button type="button" onclick="deleteArticle()"
            class="text-xl bg-red-500 hover:bg-red-400 text-white font-bold py-1 px-3 rounded">刪除</button>
    </div>
    {{-- @foreach ($articles as $article) --}}
    <a href="{{route('TagView',['tag'=>$article->tag_name])}}"
        class="px-2 text-sm rounded-sm  text-white bg-blue-500">{{$article->tag_name}}</a>
    <h2 class="mb-1 text-3xl font-medium">{{$article->title}}</h2>
    <p class="my-3 text-gray-400 font-light tracking-wider">{{date('Y-m-d H:i:s', strtotime($article->created_at))}}</p>
    <div class="content my-5" style="line-height: 2;
    letter-spacing: 1.2px;
    font-weight: 300;
    font-size: 1.3rem;">
        {!!$article->content!!}
    </div>
    {{-- @endforeach --}}

</div>

<div id="imgModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="imgbox">
    <div id="caption"></div>
</div>
@endsection


@section('script')
<script>
    //圖片放大
    var modal = document.getElementById("imgModal");
    var modalImg = document.getElementById("imgbox");
    const img = document.getElementsByTagName("img");
    console.log(img);
    for (var a = 0; a < img.length; a++) {
        img[a].addEventListener("click", function (el) {
            modal.style.display = "block";
            modalImg.src = this.getAttribute('src');
        }, false)
    }

    function changeImage(el) {
        el = el.target;
        el.setAttribute("src", "someimage");
    }
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function () {
        modal.style.display = "none";
        modalImg.src = ''
    }
    modal.onclick = function () {
        modal.style.display = "none";
        modalImg.src = ''
    }

    const article_id = `{{$article->article_id}}`;
    const deleteArticle = () => {
        console.log(`{{route("Delete")}}`);
        $.ajax({
            type: 'POST',
            url: '{{route("Delete")}}',
            data: {
                article_id: article_id
            },
            success: function (res) {
                console.log(res);
                if (res.success) {
                    alert('成功刪除')
                    location.href = "/"
                    // location.reload()

                }
            }
        })
    }

</script>
@endsection

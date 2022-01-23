@extends('layout')

@section('head')
<title>發布文章 - Ian前後端筆記</title>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<style>
    label {
        display: block;
        position: relative;
        padding-left: 30px;
        /* margin-bottom: 12px; */
        margin-right: 25px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    label input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        height: 25px;
        width: 25px;

        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    label:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    label input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    label input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    label .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }

</style>
@endsection



@section('bodyContent')

<form class="w-3/5 mx-auto">
    @csrf
    <div class="flex flex-wrap my-3">
        @foreach ($tags as $key => $tag)
        <label>{{$tag->tag_name}}
            <input type="radio" name="tag" {{$key==0 ? 'checked' : ''}} value="{{$tag->id}}">
            <span class="checkmark"></span>
        </label>

        {{-- <label><input type="radio" name="tag" value="{{$tag->tag_name}}">{{$tag->tag_name}}</label> --}}
        @endforeach
    </div>


    <input type="text" name="title" class="border rounded py-1 px-2 text-xl bg-white w-full my-2" placeholder="標題">
    <textarea id="mytextarea" name="content"></textarea>
    <div class="text-right my-2">
        <button type="button" onclick="submitArticle()"
            class="py-1 px-3 bg-red-500 hover:bg-red-400 text-white rounded-md text-2xl font-medium">送　出</button>
        <button type="button" onclick="history.back()"
            class="py-1 px-3 bg-gray-500 hover:bg-gray-400 text-white rounded-md text-2xl font-medium">取　消</button>
    </div>
</form>

@endsection


@section('script')

<script src="https://cdn.tiny.cloud/1/66eqi5hu6pnmybzh8uiexqi0bgd4ue0n01tro0ax0t0gh8yf/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    const article_id = Math.floor(Date.now() / 1000);
    const timestamp = new Date
    const date =
        `${timestamp.getFullYear()}-${(timestamp.getMonth()+1)>9?timestamp.getMonth()+1:'0'+ (timestamp.getMonth()+1)}-${timestamp.getDate()}`
    console.log(date);
    tinymce.init({
        selector: 'textarea',
        plugins: 'image code',
        min_height: 500,
        document_base_url: "storage/uploads/",
        toolbar: [{
                name: 'history',
                items: ['undo', 'redo']
            },
            {
                name: 'styles',
                items: ['styleselect']
            },
            {
                name: 'formatting',
                items: ['bold', 'italic']
            },
            {
                name: 'alignment',
                items: ['alignleft', 'aligncenter', 'alignright', 'alignjustify']
            },
            {
                name: 'indentation',
                items: ['outdent', 'indent']
            },
            {
                name: 'image',
                items: ['image']
            }
        ],
        // toolbar: 'undo redo | link image | code',
        image_title: true,
        // automatic_uploads: true,
        images_upload_url: `/api/uploadimage/${article_id}/${date}`,
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
            console.log('file_picker_callback');
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                var file = this.files[0];
                console.log('file', file);
                const formData = new FormData();
                formData.append('file', file)
                formData.append('article_id', article_id)
                formData.append('date', date)

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                    console.log('打api');

                };

            };
            input.click();
        }
    });

    const submitArticle = () => {
        $.ajax({
            type: 'POST',
            url: '{{route("Create")}}',
            data: {
                title: $('input[name="title"]').val(),
                content: tinyMCE.get('mytextarea').getContent(),
                tag: $('input[name="tag"]:checked').val(),
                article_id: article_id,
                account: `{{session()->get('account')}}`,
                token: `{{session()->get('token')}}`,
            },
            success: function (res) {
                console.log(res);
                if (res.success) {
                    alert('成功送出')
                    location.reload()
                }
            }
        })
    }

</script>

@endsection

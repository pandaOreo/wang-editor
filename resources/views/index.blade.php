<div class="{{$viewClass['form-group']}}">
    <label class="{{$viewClass['label']}} control-label">富文本</label>
    <div class="{{$viewClass['field']}}">
        <input type="hidden" id="details" name="{{$name}}" value="{{old($column, $value)}}">
        <div class="extension-demo">
            @csrf
            <div id="{{$name}}">
                @if($value)
                <p>{!! $value !!}</p>
                @else
                <p></p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- 引入 wangEditor.min.js -->
<script type="text/javascript">
    const E = window.wangEditor
    const editor = new E('#' + "{{$name}}")
    // editor.config.showLinkImg = false
    editor.config.height = 500
    editor.config.uploadImgMaxLength = 5 // 一次最多上传 5 个图片
    // editor.config.uploadImgShowBase64 = true
    editor.config.uploadImgServer = '/admin/api/upload/image'
    editor.config.uploadFileName = 'wangpic'
    editor.config.uploadImgAccept = ['jpg', 'jpeg', 'png', 'gif']
    editor.config.uploadImgMaxSize = 10 * 1024 * 1024 // 10M
    editor.config.uploadImgHeaders = {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
    // 或者 const editor = new E( document.getElementById('div1') )

    // 视频
    editor.config.uploadVideoServer = '/admin/api/upload/video'
    editor.config.uploadVideoName = 'wangvideo'
    editor.config.uploadVideoHeaders = {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
    // 配置 onchange 回调函数
    editor.config.onchange = function(newHtml) {
        console.log("change 之后最新的 html", newHtml);
        $("input[name={{$name}}]").val(newHtml);
    };
    // editor.txt.html("{!! $value !!}");
    editor.create()
</script>

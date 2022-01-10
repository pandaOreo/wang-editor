<div class="extension-demo">
    <div id="div1">
        @csrf
        <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
    </div>
</div>

<script src="../vendor/dcat-admin-extensions/panda-oreo/wang-editor/js/wangEditor.min.js"></script>
<!-- 引入 wangEditor.min.js -->
<script type="text/javascript">
    const E = window.wangEditor
    const editor = new E('#div1')
    // editor.config.showLinkImg = false
    editor.config.height = 500
    editor.config.uploadImgMaxLength = 5 // 一次最多上传 5 个图片
    editor.config.uploadImgShowBase64 = true
    editor.config.uploadImgAccept = ['jpg', 'jpeg', 'png', 'gif']
    editor.config.uploadImgMaxSize = 10 * 1024 * 1024 // 10M
    // 或者 const editor = new E( document.getElementById('div1') )

    // 视频
    editor.config.uploadVideoServer = '/admin/api/upload/video'
    editor.config.uploadVideoName = 'wangvideo'
    editor.config.uploadVideoHeaders = {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
    editor.create()
</script>

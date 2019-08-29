<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea.fn_post_editor',
        language: "{{ app()->getLocale() }}",
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link code | help',
    });

    tinymce.init({
        selector: 'textarea.fn_comment_editor',
        language: "{{ app()->getLocale() }}",
        menubar: false,
        plugins: [
            'advlist autolink link',
            'searchreplace code',
        ],
        toolbar: 'undo redo | bold italic underline strikethrough | link code'
    });
</script>
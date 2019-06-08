<template>
    <div>

        <div class="document-editor">
            <div class="document-editor__toolbar"></div>
            <div class="document-editor__editable-container">
                <div id="editor" class="document-editor__editable">
                    <p class="fs0-8 text-editor"></p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

    export default {
        mounted() {
                this.$nextTick(function() {
                    $(document).ready(function () {

                        DecoupledEditor
                            .create( document.querySelector( '.document-editor__editable' ) , {
                                language:'fa',
                            } )
                            .then( editor => {

                                const toolbarContainer = document.querySelector( '.document-editor__toolbar' );
                                toolbarContainer.appendChild( editor.ui.view.toolbar.element );

                                window.editor = editor;
                                editor.plugins.get('FileRepository').createUploadAdapter = (loader)=>{
                                    return new UploadAdapter(loader);
                                };

                                editor.config.get( 'image.toolbar' );

                                $('.btn-insert-post').click(function () {
                                    const contentData = editor.getData();
                                    $('.content-data').val(contentData);
                                })

                            } )
                            .catch( error => {
                                console.error( error );
                            } );


                        class UploadAdapter {
                            constructor(loader) {
                                this.loader = loader;
                            }
                            upload() {
                                return this.loader.file
                                    .then( uploadedFile => {
                                        return new Promise((resolve, reject) => {

                                            const data = new FormData();
                                            /*data.append("_token", "{{csrf_token()}}");*/
                                            data.append("_token",  $('meta[name="csrf-token"]').attr('content'));
                                            data.append('upload', uploadedFile );
                                            console.log(uploadedFile);
                                            data.append('allowSize', 10);
                                            $.ajax({
                                                url: 'http://localhost:8000/api/upload/post',
                                                type: 'POST',
                                                data: data,
                                                dataType: 'json',
                                                processData: false,
                                                contentType: false,
                                                success: function (data) {
                                                    if (data.res) {
                                                        var imageIds = '';
                                                        var imageIdNew = data.id;
                                                        var imageIdOld = $('.photo-ids').val();
                                                        if (imageIdOld === ''){
                                                            imageIds = imageIdNew;
                                                        } else {
                                                            imageIds = imageIdOld + ',' + imageIdNew;
                                                        }

                                                        $('.photo-ids').val(imageIds);
                                                        resolve({
                                                            default: data.url
                                                        });

                                                    } else {
                                                        reject(data.msg);
                                                    }
                                                }
                                            });
                                        });
                                    })
                            }
                            abort() {
                            }
                        }
                    })
                })
            }
    }
</script>

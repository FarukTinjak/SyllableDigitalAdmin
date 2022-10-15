@extends('dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item">Blog posts</li>
    <li class="breadcrumb-item active">{{$post->id == 0 ? 'New' : 'Edit'}} Blog Post</li>
@endsection

@section('title', ($post->id ? 'Edit' : 'New') . ' Blog Post')

@section('content')
    <input type="hidden" name="postID" id="postID" value="{{$post->id}}">

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Blog post</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputTitle">Title</label>
                            <input type="text" id="inputTitle" class="form-control" value="{{$post->title}}">
                        </div>
                        <div class="form-group">
                            <label for="inputSubtitle">Subtitle</label>
                            <input type="text" id="inputSubtitle" class="form-control" value="{{$post->subtitle}}">
                        </div>
                        <div class="form-group">
                            <label for="inputDate">Date</label>
                            <input type="datetime-local" id="inputDate" class="form-control" value="{{$post->created_at}}">
                        </div>
                        <div class="form-group">
                            <label for="inputThumbnail">Thumbnail image</label>
                            <input type="file" id="inputThumbnail" name="thumbnail" class="form-control" accept=".jpeg, .png, .jpg, .gif" {{!$post->id ? 'required' : ''}}>
                            @if($post->thumbnail_path)
                                <img src="{{asset($post->thumbnail_path)}}" style="max-height: 400px" class="mt-2">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputContent">Content</label>
                            <div class="ce-example__content _ce-example__content--small">
                                <div id="editorjs"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="{{route('dashboard.blog')}}" onclick="return confirm('Are you sure you want to go back?')" class="btn btn-secondary">Back</a>
                        <button type="button" class="btn btn-success saveButton">{{$post->id ? 'Update' : 'Create'}}</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <style>
        /* This hides default link settings, because hyperlink is integrated */
        .ce-inline-toolbar__buttons .ce-inline-tool--link[data-tool='link'] {display: none!important}

        .cdx-settings-button[data-tune='withBorder'],
        .cdx-settings-button[data-tune='withBackground'],
        .cdx-settings-button[data-tune='stretched'] {
            display: none;
        }
    </style>
@stop
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script>

    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-hyperlink@1.0.6/dist/bundle.min.js"></script>
    <script>
        if(!$('#inputDate').val()){
            var now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            $('#inputDate').val(now.toISOString().slice(0,16));
        }
        /**
         * To initialize the Editor, create a new instance with configuration object
         * @see docs/installation.md for mode details
         */

        var editor = new EditorJS({

            holder: 'editorjs',
            placeholder: 'Let`s write an awesome story!',

            tools: {

                Marker: Marker,
                inlineCode: InlineCode,

                header: {
                    class: Header,
                    inlineToolbar: true,
                    config: {
                        placeholder: 'Header'
                    },
                    toolbox: [
                        {
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448 448c0 17.69-14.33 32-32 32h-96c-17.67 0-32-14.31-32-32s14.33-32 32-32h16v-144h-224v144H128c17.67 0 32 14.31 32 32s-14.33 32-32 32H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h16v-320H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h96c17.67 0 32 14.31 32 32s-14.33 32-32 32H112v112h224v-112H320c-17.67 0-32-14.31-32-32s14.33-32 32-32h96c17.67 0 32 14.31 32 32s-14.33 32-32 32h-16v320H416C433.7 416 448 430.3 448 448z"/></svg>',
                            title: 'Heading 1',
                            data: {
                                level: 1,
                            },
                        },
                        {
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448 448c0 17.69-14.33 32-32 32h-96c-17.67 0-32-14.31-32-32s14.33-32 32-32h16v-144h-224v144H128c17.67 0 32 14.31 32 32s-14.33 32-32 32H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h16v-320H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h96c17.67 0 32 14.31 32 32s-14.33 32-32 32H112v112h224v-112H320c-17.67 0-32-14.31-32-32s14.33-32 32-32h96c17.67 0 32 14.31 32 32s-14.33 32-32 32h-16v320H416C433.7 416 448 430.3 448 448z"/></svg>',
                            title: 'Heading 2',
                            data: {
                                level: 2,
                            },
                        },
                        {
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448 448c0 17.69-14.33 32-32 32h-96c-17.67 0-32-14.31-32-32s14.33-32 32-32h16v-144h-224v144H128c17.67 0 32 14.31 32 32s-14.33 32-32 32H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h16v-320H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h96c17.67 0 32 14.31 32 32s-14.33 32-32 32H112v112h224v-112H320c-17.67 0-32-14.31-32-32s14.33-32 32-32h96c17.67 0 32 14.31 32 32s-14.33 32-32 32h-16v320H416C433.7 416 448 430.3 448 448z"/></svg>',
                            title: 'Heading 3',
                            data: {
                                level: 3,
                            },
                        }
                    ],

                    shortcut: 'CMD+SHIFT+H'
                },
                hyperlink: {
                    class: Hyperlink,
                    config: {
                        shortcut: 'CMD+L',
                        target: '_blank',
                        rel: 'nofollow',
                        availableTargets: ['_blank', '_self'],
                        availableRels: ['author', 'noreferrer'],
                        validate: false,
                    }
                },

                image: {
                    class: ImageTool,
                    config: {
                        endpoints: {
                            byFile: '{{route('images.uploadfile')}}',
                            byUrl: '{{route('images.uploadurl')}}',
                        },
                        additionalRequestData : {
                            _token: "{{csrf_token()}}"
                        }
                    }
                },

                list: {
                    class: NestedList,
                    inlineToolbar: true,
                    shortcut: 'CTRL+SHIFT+L'
                },


                quote: {
                    class: Quote,
                    inlineToolbar: true,
                    config: {
                        quotePlaceholder: 'Enter a quote',
                        captionPlaceholder: 'Quote\'s author',
                    },
                    shortcut: 'CMD+SHIFT+O'
                },

                code: {
                    class: CodeTool,
                    shortcut: 'CMD+SHIFT+C'
                },

                delimiter: Delimiter,
                linkTool: LinkTool,

                embed: {
                    class: Embed,
                    inlineToolbar: true,

                },

            },

            data: {!! !empty($post->content) ? $post->content : "\"\"" !!},

            onReady: function() {
            },
            onChange: function() {
                console.log('something changed');
            }

        });

        $('.saveButton').click(function() {
            event.preventDefault();

            editor.save().then((savedData) => {
                const data = new FormData();
                data.append('id', $('#postID').val());
                data.append('title', $('#inputTitle').val());
                data.append('subtitle', $('#inputSubtitle').val());
                data.append('content', JSON.stringify(savedData));
                data.append('created_at', $('#inputDate').val());
                data.append('thumbnail', $('#inputThumbnail').prop('files')[0]);
                data.append('_token', "{{ csrf_token()}}");

                $.ajax({
                    type: 'POST',
                    processData: false, // important
                    contentType: false, // important
                    data: data,
                    url: '{{route('dashboard.blog.save')}}',
                    dataType : 'json'
                })
                .done(function(result) {
                    location.href = '{{route('dashboard.blog.edit', ['id' => false])}}/' + result.id;
                })
                .fail(function(error){
                    alert('Failed to save post');
                });
            })
            .catch((error) => {
                console.error('Saving error', error);
            });
        });
    </script>
@stop

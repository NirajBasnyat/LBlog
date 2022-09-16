@extends('layouts.app')

@section('content')

    <x-breadcrumb listRoute="{{route('blogs.index')}}" model="Blog" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create a New Blog</h4><br>

            <x-form.wrapper action="{{route('blogs.store')}}" method="POST" enctype="multipart/form-data">

                <x-form.input type="text" label="Title" id="title" name="title" value="{{old('title')}}"/>

                <x-form.textarea label="Content" id="content" name="content" value="{{old('content')}}" rows="5" cols="5"/>

                <div class="row">
                    <label class="required col-md-2" for="categories">Add Categories</label>
                    <div class="col-md-10">
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-sm btn-info btn-shadow select-all" style="border-radius: 0">Select All</span>
                            <span class="btn btn-sm btn-danger btn-shadow deselect-all" style="border-radius: 0">Remove All</span>
                        </div>
                        <select class="form-control select2" name="categories[]" id="categories" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-save bx-xs"></i></x-form.button>
            </x-form.wrapper>

        </div>
    </div>

@endsection

@push('custom_js')
    @include('_custom_includes.select2')

    <script>
        class MyUploadAdapter {
            constructor( loader ) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then( file => new Promise( ( resolve, reject ) => {
                        this._initRequest();
                        this._initListeners( resolve, reject, file );
                        this._sendRequest( file );
                    } ) );
            }

            // Aborts the upload process.
            abort() {
                if ( this.xhr ) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open( 'POST', '{{ route('ck_image.store') }}', true );
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners( resolve, reject, file ) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                xhr.addEventListener( 'abort', () => reject() );
                xhr.addEventListener( 'load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if ( !response || response.error ) {
                        return reject( response && response.error ? response.error.message : genericErrorText );
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve( {
                        default: response.url
                    } );
                } );

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if ( xhr.upload ) {
                    xhr.upload.addEventListener( 'progress', evt => {
                        if ( evt.lengthComputable ) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    } );
                }
            }

            // Prepares the data and sends the request.
            _sendRequest( file ) {
                // Prepare the form data.
                const data = new FormData();

                data.append( 'upload', file );

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send( data );
            }

            // ...
        }

        function SimpleUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter( loader );
            };
        }

        ClassicEditor
            .create( document.querySelector( '#content' ), {
                extraPlugins: [ SimpleUploadAdapterPlugin ],
            } )
            .then( editor => {
                // Simulate label behavior if textarea had a label
                if (editor.sourceElement.labels.length > 0) {
                    editor.sourceElement.labels[0].addEventListener('click', e => editor.editing.view.focus());
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>


@endpush
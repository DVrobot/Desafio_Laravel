@extends('admin.layouts.app')
@section('content')
    @component('admin.components.show')
        @slot('title', $course->name)
        @slot('form')
            <div class=" float-left col-4 d-inline-block align-top">
                <img class="img-fluid border" src="{{ asset('storage/' . $course->image_link ) }}" >
            </div>
            <h4>Informações:</h4>
            <ul class="list-group-flush float-right col-8 d-inline-block align-top">
                <li class="list-group-item"><b>Categoria: </b>{{ $course->category->name }}</li>
                <li class="list-group-item"><b>Descrição: </b><textarea class="summertext" type="text" rows="6">{{ $course->description }}</textarea></li>
            </ul>
            
            {{ $video_link }}
            <div class="embed-responsive embed-responsive-16by9  mt-3">
                <iframe class="col-12" src=" {{ $video_link }}" allowfullscreen></iframe>
            </div>

        @endslot
    @endcomponent
@endsection


@push('scripts')
    <script>
        $('.form-control').attr('readonly',true);
        $(document).ready(function() {
                $('.summertext').summernote({
                    toolbar: [],
                    disableDragAndDrop: true,
                    disableResizeEditor: true,
                });
                $('.summertext').summernote('disable');
            });
            
    </script>
    </script>
@endpush

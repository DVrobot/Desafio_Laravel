@extends('admin.layouts.app')
@section('content')
    @component('admin.components.show')
        @slot('title', $course->name)
        @slot('form')
            <div class=" float-left col-4 d-inline-block align-top">                
                <img class="img-fluid border"  src="{{ asset('storage/img/' . $course->image_link ) }}" >
            </div>
            <ul class="list-group-flush float-right col-8 d-inline-block align-top">
                <li class="list-group-item">
                    <b> Status: </b>
                    @if( Auth::user()->containsCourse($course) )
                        <span class="text-success"> Inscrito </span>
                    @else 
                        <span class="text-danger"> Desinscrito </span>
                    @endif
                </li>
                <li class="list-group-item"><b>Categoria: </b>{{ $course->category->name }}</li>
                <li class="list-group-item"><textarea class="summertext" type="text"    >{{ $course->description }}</textarea></li>
            </ul>
            <div class="embed-responsive embed-responsive-16by9  my-3">
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

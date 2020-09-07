@extends('admin.layouts.app')

@section('content')
    @component('admin.components.table')
        @slot('title', 'Listagem')
        @slot('create', route('courses.create'))
        @slot('head')
            <th>Nome</th>
            <th>Categoria</th>
            <th></th>
        @endslot
        @slot('body')
            @foreach($courses as $course)
                @can('view', $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->category->name }}</td>
                        <td class="options">
                            <form action="{{ route('courses.subscription', $course) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" required value="{{Auth::user()->id}}" id="user" name="user">
                                @if( !(Auth::user()->containsCourse($course) ) )
                                    <input type="hidden" name="subscribe" id="subscribe" class="form-control" required value="1">
                                    <button class="btn btn-success"><i class="fas fa-clipboard-check"></i></button>
                                @else
                                    <input type="hidden" name="subscribe" id="subscribe" class="form-control" required value="0">
                                    <button class="btn btn-danger"><i class="fas fa-clipboard-check"></i></button>
                                @endif
                            </form> 
                            @can('update',$course)
                                <a href="{{ route('courses.edit', $course ) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                            @endcan
                            @can('view',$course)
                                <a href="{{ route('courses.show', $course ) }}" class="btn btn-dark"><i class="fas fa-search"></i></a>
                            @endcan
                            @can('delete',$course)
                                <form action="{{ route('courses.destroy', $course ) }}" class="form-delete" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endcan
            @endforeach
        @endslot
    @endcomponent
@endsection

@push('scripts')
        <script src="{{ asset('js/components/dataTable.js') }}"></script>
        <script src="{{ asset('js/components/sweetAlert.js') }}"></script>
@endpush
    
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
    
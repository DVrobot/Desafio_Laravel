@extends('admin.layouts.app')

@section('content')
    @component('admin.components.table')
        @slot('title', 'Listagem')
        @slot('create', route('categories.create'))
        @slot('head')
            <th>Nome</th>
            <th></th>
        @endslot
        @slot('body')
            @foreach($categories as $category)
                @can('view', $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td class="options"> 
                            @can('update',$category)
                                <a href="{{ route('categories.edit', $category->id ) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                            @endcan
                            @can('view',$category)
                                <a href="{{ route('categories.show', $category->id ) }}" class="btn btn-dark"><i class="fas fa-search"></i></a>
                            @endcan
                            @can('delete',$category)
                                <form action="{{ route('categories.destroy', $category->id) }}" class="form-delete" method="post">
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
    
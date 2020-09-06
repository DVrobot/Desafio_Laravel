<div class="row">
    <div class="form-group col-6">
        <label for="name" class="required">Nome </label>
        <input type="text" name="name" id="name" required class="form-control" autofocus value="{{ old('name', $course->name )}}">
    </div>
    <div class="form-group col-6">
        <label for="video" class="required">Link do video </label>
        <input type="video" name="video" id="video" autocomplete="off" required class="form-control" value="{{ old('video', $course->video )}}">
    </div>
    <div class="form-group col-6">
        <label for="category_id" class="required" >Categoria</label>
        <select name="category_id" id="category_id" class="form-control select2" value="{{ old('category_id', $course->category_id) }}">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"  class="select2">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-6">  
        <label for="image_link" class="required">Imagem </label>
        <input type="file" accept="image/*" class="form-control-file" name="image_link" required>
    </div>
    <div class="form-group col-sm-12 col-md-12" >
        <label for="description" class="required">Descrição: </label>   
        <textarea type="text" name="description" id="description" class="form-control" rows="6" required value="{{ old('description',$course->description) }}">{{ old('description',$course->description) }}</textarea>
    </div>
</div>

@push('scripts')
    <script>
        $(function(){
            $('.select2').select2();
        })
        $('select[value]').each(function(){
            $(this).val($(this).attr('value'));
        })
        $(document).ready(function() {
                $('textarea').summernote({
                    tabsize: 2,
                    height: 120,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol','dl', 'paragraph']],
                        ['view', ['fullscreen']]
                    ]
                });
            });
    </script>
@endpush
@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            @include('admin.shared.sidebar')
            <div class="col-12 col-md-9 p-4">
                @if (session('message'))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('message') }}</strong>
                    </div>
                @endif
                <div class="container-fluid py-4 bg-white border rounded border-light shadow">
                    <h2 class="text-center font-weight-bold text-uppercase">Добавить товар</h2>
                    {!! Form::open(['route'=>'admin.products.store', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Название товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::text('title', old('title'), ['placeholder'=>'Название товара'] + ($errors->has('title') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Цена товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::number('price', old('price'), ['step'=>'0.01', 'placeholder'=>'Цена товара'] + ($errors->has('price') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('category', 'Категория:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::select('category', $categories, old('category'), ['placeholder'=>'Вибрать категорию'] + ($errors->has('category') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                        </div>
                        <div class="form-group ml-4">
                            {!! Form::checkbox('promo_action', '1', false, ['class'=>'form-check-input']) !!}
                            {!! Form::label('promo_action', 'Акция', ['class' => 'text-uppercase font-weight-bold']) !!}
                            <span class="text-danger">{{ $errors->first('promo_action') }}</span>
                        </div>
                        <div class="form-group ml-4">
                            {!! Form::checkbox('best', '1', false, ['class'=>'form-check-input']) !!}
                            {!! Form::label('best', 'Лучшее', ['class' => 'text-uppercase font-weight-bold']) !!}
                            <span class="text-danger">{{ $errors->first('best') }}</span>
                        </div>
                        <div class="form-group ml-4">
                            {!! Form::checkbox('novelty', '1', false, ['class'=>'form-check-input']) !!}
                            {!! Form::label('novelty', 'Новинка', ['class' => 'text-uppercase font-weight-bold']) !!}
                            <span class="text-danger">{{ $errors->first('novelty') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('main_photo', 'Вибрати главное фото товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::file('main_photo', ($errors->has('main_photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('main_photo') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('short_description', 'Краткое описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::textarea('short_description', old('short_description'), ['placeholder' => 'Краткое описание'] + ($errors->has('short_description') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('short_description') }}</span>
                        </div>
                        <div id="productAttributes"></div>
                        <button type="button" class="btn btn-primary w-100 my-4 text-uppercase font-weight-bold" onclick="addNewAttribute()">Добавить характеристику товара</button>
                        <div class="form-group">
                            {!! Form::label('description', 'Основная часть:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::textarea('description', old('description'), ['id' => 'editor'] + ($errors->has('description') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('titleSEO', 'SEO заголовок:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::text('titleSEO', old('titleSEO'), ['placeholder'=>'SEO заголовок'] + ($errors->has('titleSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('titleSEO') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('descriptionSEO', 'Мета описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::textarea('descriptionSEO', old('descriptionSEO'), ['placeholder'=>'Мета описание'] + ($errors->has('descriptionSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('descriptionSEO') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('keywordsSEO', 'Ключевые слова:', ['class' => 'text-uppercase font-weight-bold']) !!}
                            {!! Form::text('keywordsSEO', old('keywordsSEO'), ['placeholder'=>'Ключевые слова'] + ($errors->has('keywordsSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                            <span class="text-danger">{{ $errors->first('keywordsSEO') }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Добавить новость', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>             
            </div>
        </div>
    </div>
</main>
<script>
    var attributeIterator = 0;
    function addNewAttribute() {
        attributeIterator++;
        var container = document.createElement("div");
        container.setAttribute('class',"form-group py-4");
        container.setAttribute('id',"attribute"+attributeIterator);

        var p = document.createElement("p");
        p.setAttribute('class',"text-uppercase font-weight-bold col-12 text-center");

        var pText = document.createTextNode("Характеристика "+attributeIterator);
        p.appendChild(pText);

        var row = document.createElement("div");
        row.setAttribute('class',"row");

        var divName = document.createElement("div");
        divName.setAttribute('class',"col-12 col-sm-6 py-2");

        var labelName = document.createElement("label");
        labelName.setAttribute('class',"text-uppercase font-weight-bold col-12");
        labelName.setAttribute('for',"attribute_name "+attributeIterator);

        var labelNameText = document.createTextNode("Название:");
        labelName.appendChild(labelNameText);

        var inputName = document.createElement("input");
        inputName.setAttribute('type',"text");
        inputName.setAttribute('id',"attribute_name "+attributeIterator);
        inputName.setAttribute('name',"attribute_name "+attributeIterator);
        inputName.setAttribute('placeholder',"Название");
        inputName.setAttribute('class',"form-control");

        divName.appendChild(labelName);
        divName.appendChild(inputName);

        var divValue = document.createElement("div");
        divValue.setAttribute('class',"col-12 col-sm-6 py-2");

        var labelValue = document.createElement("label");
        labelValue.setAttribute('class',"text-uppercase font-weight-bold col-12");
        labelValue.setAttribute('for',"attribute_value "+attributeIterator);

        var labelValueText = document.createTextNode("Значение:");
        labelValue.appendChild(labelValueText);

        var inputValue = document.createElement("input");
        inputValue.setAttribute('type',"text");
        inputValue.setAttribute('id',"attribute_value "+attributeIterator);
        inputValue.setAttribute('name',"attribute_value "+attributeIterator);
        inputValue.setAttribute('placeholder',"Значение");
        inputValue.setAttribute('class',"form-control");

        divValue.appendChild(labelValue);
        divValue.appendChild(inputValue);

        row.appendChild(divName);
        row.appendChild(divValue);

        container.appendChild(p);
        container.appendChild(row);
        
        document.getElementById('productAttributes').appendChild(container);
    }
</script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endsection
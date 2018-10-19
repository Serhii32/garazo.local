@extends('layouts.app')

@section('content')
<link href="{{ asset('css/products-attributes-autocomplete.css') }}" rel="stylesheet">
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
                <div class="py-4 bg-white border rounded border-light shadow">
                    {!! Form::open(['route'=> ['admin.products.update', $product->id], 'autocomplete' => 'off', 'method' => 'put', 'files' => true]) !!}
                        <h2 class="text-center font-weight-bold text-uppercase pb-5">Редактировать {{ $product->title }}</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <img class="img-thumbnail img-fluid" src="{{$product->main_photo ? asset($product->main_photo) : asset('img/common/default.png')}}" alt="{{ $product->title }}">
                                    <div class="form-group">
                                        {!! Form::label('main_photo', 'Вибрать главное фото товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::file('main_photo', ($errors->has('main_photo') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('main_photo') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('title', 'Название товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text('title', $product->title, ['placeholder'=>'Название товара', 'autofocus' => 'autofocus'] + ($errors->has('title') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price', 'Цена товара:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::number('price', $product->price, ['step'=>'0.01', 'placeholder'=>'Цена товара'] + ($errors->has('price') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('short_description', 'Краткое описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::textarea('short_description', $product->short_description, ['placeholder'=>'Краткое описание'] + ($errors->has('short_description') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('category', 'Вибрать категорию:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::select('category',$categories, $product->category_id, ['placeholder'=>'Вибрать категорию'] + ($errors->has('category') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('titleSEO', 'SEO заголовок:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text('titleSEO', $product->titleSEO, ['placeholder'=>'SEO заголовок'] + ($errors->has('titleSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('titleSEO') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('descriptionSEO', 'Мета описание:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::textarea('descriptionSEO', $product->descriptionSEO, ['placeholder'=>'Мета описание'] + ($errors->has('descriptionSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('descriptionSEO') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('keywordsSEO', 'Ключевые слова:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        {!! Form::text('keywordsSEO', $product->keywordsSEO, ['placeholder'=>'Ключевые слова'] + ($errors->has('keywordsSEO') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                        <span class="text-danger">{{ $errors->first('keywordsSEO') }}</span>
                                    </div>
                                    <div class="form-group ml-4">
                                        {!! Form::checkbox('promo_action', '1', $product->promo_action, ['class'=>'form-check-input']) !!}
                                        {!! Form::label('promo_action', 'Акция', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        <span class="text-danger">{{ $errors->first('promo_action') }}</span>
                                    </div>
                                    <div class="form-group ml-4">
                                        {!! Form::checkbox('best', '1', $product->best, ['class'=>'form-check-input']) !!}
                                        {!! Form::label('best', 'Лучшее', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        <span class="text-danger">{{ $errors->first('best') }}</span>
                                    </div>
                                    <div class="form-group ml-4">
                                        {!! Form::checkbox('novelty', '1', $product->novelty, ['class'=>'form-check-input']) !!}
                                        {!! Form::label('novelty', 'Новинка', ['class' => 'text-uppercase font-weight-bold']) !!}
                                        <span class="text-danger">{{ $errors->first('novelty') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div id="productAttributes">

                                @if(!empty(old('attributes_names')) || !empty($product->attributesNames()->get()))
                                    @php $i = 0; @endphp
                                    @if(!empty($product->attributesNames()->get()))
                                        @for($i; $i < count($product->attributesNames()->get()); $i++)
                                            <div class="existed-attributes form-group py-4 border-bottom" id="attribute{{$i+1}}">
                                                <div class="row">
                                                    <p class="text-uppercase font-weight-bold col-12 col-sm-6">Характеристика {{$i+1}}</p>
                                                    {{-- <div class="col-12 col-sm-6">
                                                        <a class="float-right btn btn-danger text-uppercase font-weight-bold" href="">Удалить</a>
                                                    </div> --}}
                                                    {!! Form::open(['route'=> ['admin.products.productAttributeDestroy', $product->id, $product->attributesNames()->get()[$i]->id, $product->attributesNames()->get()[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->first()->id], 'method' => 'delete', 'class' => 'col-12 col-sm-6', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                                                        {!! Form::submit('Удалить', ['class'=>'float-right btn btn-danger text-uppercase font-weight-bold']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 py-2">
                                                        <label class="text-uppercase font-weight-bold col-12" for="attribute_name_{{$i+1}}">Название:</label>
                                                        <input type="text" id="attribute_name_{{$i+1}}" name="attributes_names[]" placeholder="Название" 
                                                        @if($errors->has('attributes_names.'.$i)) class="form-control autocomplete-list-target-name is-invalid" 
                                                        @else class="form-control autocomplete-list-target-name"
                                                        @endif 
                                                        value="{{$product->attributesNames()->get()[$i]->name}}">
                                                        <span class="text-danger">{{ $errors->first('attributes_names.'.$i) }}</span>
                                                    </div>
                                                    <div class="col-12 col-sm-6 py-2">
                                                        <label class="text-uppercase font-weight-bold col-12" for="attribute_value {{$i+1}}">Значение:</label>
                                                        <input type="text" id="attribute_value {{$i+1}}" name="attributes_values[]" placeholder="Значение" 
                                                        @if($errors->has('attributes_values.'.$i)) class="form-control autocomplete-list-target-value is-invalid"
                                                        @else class="form-control autocomplete-list-target-value"
                                                        @endif
                                                        value="{{$product->attributesNames()->get()[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->first()->value}}">
                                                        <span class="text-danger">{{ $errors->first('attributes_values.'.$i) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                    @if(!empty(old('attributes_names')))
                                        @for($i; $i < count(old('attributes_names')); $i++)
                                            <div class="existed-attributes form-group py-4 border-bottom" id="attribute{{$i+1}}">
                                                <div class="row">
                                                    <p class="text-uppercase font-weight-bold col-12 col-sm-6">Характеристика {{$i+1}}</p>
                                                    <div class="col-12 col-sm-6">
                                                        <a class="float-right btn btn-danger text-uppercase font-weight-bold" onclick="deleteAttribute('attribute{{$i+1}}')" href="javascript:void(0)">Удалить</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 py-2">
                                                        <label class="text-uppercase font-weight-bold col-12" for="attribute_name_{{$i+1}}">Название:</label>
                                                        <input type="text" id="attribute_name_{{$i+1}}" name="attributes_names[]" placeholder="Название" 
                                                        @if($errors->has('attributes_names.'.$i)) class="form-control autocomplete-list-target-name is-invalid" 
                                                        @else class="form-control autocomplete-list-target-name"
                                                        @endif 
                                                        value="{{old('attributes_names.'.$i)}}">
                                                        <span class="text-danger">{{ $errors->first('attributes_names.'.$i) }}</span>
                                                    </div>
                                                    <div class="col-12 col-sm-6 py-2">
                                                        <label class="text-uppercase font-weight-bold col-12" for="attribute_value {{$i+1}}">Значение:</label>
                                                        <input type="text" id="attribute_value {{$i+1}}" name="attributes_values[]" placeholder="Значение" 
                                                        @if($errors->has('attributes_values.'.$i)) class="form-control autocomplete-list-target-value is-invalid"
                                                        @else class="form-control autocomplete-list-target-value"
                                                        @endif
                                                        value="{{old('attributes_values.'.$i)}}">
                                                        <span class="text-danger">{{ $errors->first('attributes_values.'.$i) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                @endif

                            </div>
                            <button id="add-new-attribute" type="button" class="btn btn-primary w-100 my-4 text-uppercase font-weight-bold" onclick="addNewAttribute()">Добавить характеристику товара</button>
                            <div class="form-group">
                                {!! Form::label('description', 'Основная часть:', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::textarea('description', $product->description, ['id'=>'editor'] + ($errors->has('description') ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Сохранить', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route'=> ['admin.products.destroy', $product->id], 'method' => 'delete', 'class' => 'mt-3', 'onsubmit' => 'return confirm("Подтвердить удаление?")']) !!}
                        <div class="col-md-6 m-auto">
                            {!! Form::submit('Удалить', ['class'=>'btn btn-danger w-100 text-uppercase font-weight-bold']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    var attributesNamesArray = {!! json_encode($attributesNamesArray) !!};
    var attributesValuesArray = {!! json_encode($attributesValuesArray) !!};
</script>
<script src="{{ asset('js/products-attributes-autocomplete.js') }}"></script>
<script src="{{ asset('js/products-add-new-attributes.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endsection
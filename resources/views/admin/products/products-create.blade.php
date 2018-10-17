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
                    {!! Form::open(['route'=>'admin.products.store', 'autocomplete' => 'off', 'files' => true]) !!}
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
                        <div id="productAttributes">
                            @if(!empty(old('attributes_names')))
                                @for($i = 0; $i < count(old('attributes_names')); $i++)
                                    <div class="existed-attributes form-group py-4 border-bottom" id="attribute{{$i+1}}">
                                        <div class="row">
                                            <p class="text-uppercase font-weight-bold col-12 col-sm-6">Характеристика {{$i+1}}</p>
                                            <div class="col-12 col-sm-6">
                                                <a class="float-right btn btn-danger text-uppercase font-weight-bold" onclick="deleteAttribute('attribute{{$i+1}}')" href="javascript:void(0)">Удалить</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 py-2">
                                                <label class="text-uppercase font-weight-bold col-12" for="attribute_name {{$i+1}}">Название:</label>
                                                <input type="text" id="attribute_name {{$i+1}}" name="attributes_names[]" placeholder="Название" 
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
                        </div>
                        <button id="add-new-attribute" type="button" class="btn btn-primary w-100 my-4 text-uppercase font-weight-bold" onclick="addNewAttribute()">Добавить характеристику товара</button>
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
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
function showSuggestedList(){    
    var autocompleteListTargetName = document.getElementsByClassName("autocomplete-list-target-name");
    for(i=0; i<autocompleteListTargetName.length; i++) {
        autocomplete(autocompleteListTargetName[i], countries);
    }
}
document.getElementById("add-new-attribute").addEventListener("click", showSuggestedList);
(function(){
    showSuggestedList();
})();
</script>
<style>

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
  margin: 0 1em;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #f1f1f1; 
  border-bottom: 1px solid #d4d4d4; 
}

.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}

.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
<script>
    var attributeIterator = document.getElementsByClassName('existed-attributes').length;
    function addNewAttribute() {
        attributeIterator++;
        var container = document.createElement("div");
        container.setAttribute('class',"form-group py-4 border-bottom");
        container.setAttribute('id',"attribute"+attributeIterator);

        var row1 = document.createElement("div");
        row1.setAttribute('class',"row");

        var p = document.createElement("p");
        p.setAttribute('class',"text-uppercase font-weight-bold col-12 col-sm-6");

        var pText = document.createTextNode("Характеристика "+attributeIterator);
        p.appendChild(pText);

        var deleteButtonDiv = document.createElement("div");
        deleteButtonDiv.setAttribute('class',"col-12 col-sm-6");

        var deleteButton = document.createElement("a");
        deleteButton.setAttribute('class', "float-right btn btn-danger text-uppercase font-weight-bold");
        deleteButton.setAttribute('onclick', "deleteAttribute('attribute"+attributeIterator+"')");
        deleteButton.setAttribute('href', "javascript:void(0)");
        var deleteButtonText = document.createTextNode("Удалить");
        deleteButton.appendChild(deleteButtonText);

        deleteButtonDiv.appendChild(deleteButton);

        row1.appendChild(p);
        row1.appendChild(deleteButtonDiv);

        var row2 = document.createElement("div");
        row2.setAttribute('class',"row");

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
        // inputName.setAttribute('name',"attribute_name "+attributeIterator);
        inputName.setAttribute('name',"attributes_names[]");
        inputName.setAttribute('placeholder',"Название");
        inputName.setAttribute('class',"form-control autocomplete-list-target-name");

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
        // inputValue.setAttribute('name',"attribute_value "+attributeIterator);
        inputValue.setAttribute('name',"attributes_values[]");
        inputValue.setAttribute('placeholder',"Значение");
        inputValue.setAttribute('class',"form-control");

        divValue.appendChild(labelValue);
        divValue.appendChild(inputValue);

        row2.appendChild(divName);
        row2.appendChild(divValue);

        container.appendChild(row1);
        container.appendChild(row2);
        
        document.getElementById('productAttributes').appendChild(container);
    }

    function deleteAttribute(element) {
        var deletedElement = document.getElementById(element);
        document.getElementById('productAttributes').removeChild(deletedElement);
        return false;
    }
</script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endsection
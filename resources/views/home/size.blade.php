<div class="modal-size">
    <h4>Nazwa dania: {{ $dish->name }}</h4>
    <span>Składniki: {{ $dish->ingredients }}</span>
    <div class="row mt-5 sizes">
        <h5>Rozmiar dania: </h5>
        @foreach ($dish->sizes as $size)
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="size" value="{{ $size->id }}" data-price="{{ $size->price }}" checked>
                <label class="form-check-label" for="size">
                    {{ $size->name }} - {{ $size->price }} zł
                </label>
            </div>
        </div>
        @endforeach
    </div>
    <hr>
    <div class="quantity-box row">
        <div class="col-sm-12 d-flex justify-content-center">
            <button class="quantity-button minus">
                <i class="fa fa-minus"></i>
            </button>
            <input type="number" id="quantity" name="quantity" min="1" value="1">
            <button class="quantity-button plus">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <hr>
</div>
<div class="p-form__item">
    <label for="{{ $name }}" class="p-form__label">{{ $slot }}</label>
    <input id="" type="{{$type ?? "text"}}" class="c-input @error("$name") is-invalid @enderror"
           name="{{ $name }}" value="{{ old("$name","$value") }}"  autocomplete="{{$name}}" autofocus>
    @error("$name")
    <span class="c-input__error">{{ $message }}</span>
    @enderror
</div>

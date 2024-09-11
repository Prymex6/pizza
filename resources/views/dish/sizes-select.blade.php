 @if ($dish->sizes->isNotEmpty())
 <option value="" disabled selected>Wybierz rozmiar</option>
 @foreach ($dish->sizes as $size)
 <option value="{{ $size->name }}" data-price="{{ $size->price }}">{{ $size->name }}</option>
 @endforeach
 </select>
 @else
 <option value="" disabled selected>Brak rozmiarów</option>
 @endif
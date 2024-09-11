<select class="form-select">
    @foreach ($settings['statuses'] ?? [] as $key => $setting)
    @if (setting('statuses.' . $key . '_name'))
    <option value="{{ preg_replace('/\D/', '', $key) }}" @if (preg_replace('/\D/', '' , $key)==$status_id) selected @endif>
        {{ setting('statuses.' . $key . '_name') }}
    </option>
    @endif
    @endforeach
</select>
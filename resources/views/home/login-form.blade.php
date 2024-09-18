<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group required">
        <label for="Login">Login: </label>
        <input type="text" class="form-control" id="login" placeholder="Login" name="login" required>
    </div>
    <div class="form-group required">
        <label for="password">Hasło: </label>
        <input type="password" class="form-control" id="password" placeholder="Hasło" name="password" required>
    </div>
    <div class="btn-box">
        <button class="btn-login">Zaloguj się</button>
    </div>
</form>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">
<head>
    @include(backpack_view('inc.head'))
</head>
<body class="app flex-row align-items-center">

  @yield('header')

  <div class="container">
    @yield('content')
    <form action="{{ route('store-assignment') }}" method="post">
        @csrf
        <input type="hidden" name="costume_id" value="{{ $costume->id }}">
        
        <div class="form-group">
            <label for="user_id">Select Children:</label>
            <select name="user_id[]" id="user_id" class="form-control" multiple required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Assign Costume</button>
        </div>
    </form>
  </div>

  <footer class="app-footer sticky-footer">
    @include('backpack::inc.footer')
  </footer>

  @yield('before_scripts')
  @stack('before_scripts')

  @include(backpack_view('inc.scripts'))

  @yield('after_scripts')
  @stack('after_scripts')

</body>
</html>



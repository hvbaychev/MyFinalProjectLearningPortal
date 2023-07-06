<nav>
<a href="{{ route('home') }}">Home</a>
<a href="{{ route('about') }}"  {{ request()->routeIs('about') ? 'disabled' : '' }}>About</a>
<a href="{{ route('contact') }}">Contacts</a>
<a href="{{ route('contact2') }}">Contacts2</a>
  --------------------- profile | logout
</nav>

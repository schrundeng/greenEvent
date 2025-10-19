
    @extends('layout')

@section('content')
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#16a34a', // hijau Tailwind
        });
    });
</script>
@endif
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      const btn = document.getElementById('menu-toggle');
      const menuMobile = document.getElementById('menu-mobile');
      btn.addEventListener('click', () => {
        menuMobile.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', menuMobile.classList.contains('hidden') ? 'false' : 'true');
      });

      const handleLogout = (btnId, formId) => {
        const btn = document.getElementById(btnId);
        const form = document.getElementById(formId);
        if (!btn || !form) return;
        btn.addEventListener('click', () => {
          Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#16a34a',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
          }).then(result => {
            if (result.isConfirmed) form.submit();
          });
        });
      };

      handleLogout('logout-btn-desktop', 'logout-form-desktop');
      handleLogout('logout-btn-mobile', 'logout-form-mobile');
    });
    </script>

    {{-- Login Form --}}
    <div class="flex justify-center items-center min-h-[90vh]">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
            <h3 class="text-center mb-6 font-bold text-2xl text-[#00C853]">Welcome Back</h3>

            @if (session('status'))
                <div class="mb-4 p-3 text-sm text-green-800 bg-green-100 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 text-sm text-red-800 bg-red-100 rounded-md">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Email/Username</label>
                    <input type="text" name="login" value="{{ old('email') }}" required autofocus class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#00C853]">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#00C853]">
                </div>

                <div class="flex items-center justify-between mb-4">

                    @if (Route::has('magic.form'))
                        <a href="{{ route('magic.form') }}" class="text-sm text-[#00C853] font-semibold hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-[#00C853] text-white font-semibold py-2 rounded-md hover:bg-[#009624] transition">
                    Log In
                </button>
            </form>

            <p class="text-center mt-4 text-gray-700">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-[#00C853] font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </div>
@endsection

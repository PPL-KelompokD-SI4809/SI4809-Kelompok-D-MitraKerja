<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lengkapi Profil - MitraKerja</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-[#0B1A30] antialiased">
    @include('partials.auth-header')

    <main class="mx-auto w-full max-w-3xl px-4 py-8 sm:px-6 sm:py-12">
        <a href="{{ route('dashboard.job_seeker') }}" class="inline-flex items-center gap-2 rounded-sm text-sm font-semibold text-[#0062E3] hover:underline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#0062E3]">
            <span aria-hidden="true">←</span> Kembali ke dashboard
        </a>

        <header class="mb-6 mt-5">
            <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">Lengkapi Profil</h1>
            <p class="mt-2 text-sm leading-relaxed text-slate-600">Kelola informasi profil pencari kerja Anda.</p>
        </header>

        <section class="scroll-mt-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8" aria-labelledby="data-diri">
            <h2 id="data-diri" class="text-xl font-bold tracking-tight">Data Diri</h2>

            @if (session('status'))
                <p class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">{{ session('status') }}</p>
            @endif

            <form action="{{ route('jobseeker.profile.update') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                @method('PATCH')

                @php($name = old('name', $user->name))
                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold">Nama lengkap <span class="font-normal text-slate-600">(wajib)</span></label>
                    <input id="name" name="name" type="text" autocomplete="name" required maxlength="255"
                           value="{{ is_string($name) ? $name : '' }}"
                           @if ($errors->has('name')) aria-invalid="true" aria-describedby="name-error" @endif
                           @class([
                               'w-full rounded-xl border px-4 py-3 text-sm outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-100',
                               'border-red-500' => $errors->has('name'),
                               'border-slate-300' => ! $errors->has('name'),
                           ])>
                    @error('name')
                        <p id="name-error" class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <dl>
                    <dt class="text-sm font-semibold">Email akun</dt>
                    <dd class="mt-2 break-all text-sm text-slate-700">{{ $user->email }}</dd>
                    <dd class="mt-1 text-xs text-slate-600">Email akun tidak dapat diubah dari halaman ini.</dd>
                </dl>

                <button type="submit" class="w-full cursor-pointer rounded-xl bg-[#0062E3] px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0062E3] sm:w-auto">Simpan Data Diri</button>
            </form>
        </section>

        <div class="mt-4 space-y-4">
            @include('profile.cv')
            @foreach ($sections as $key => [$title, $fields])
                @include('profile.detail-section')
            @endforeach
        </div>
    </main>
    <script>
        document.querySelectorAll('[data-profile-list]').forEach(form => {
            const entries = form.querySelector('[data-entries]');
            const addButton = form.querySelector('[data-add-entry]');
            let nextIndex = entries.children.length;

            const refresh = () => {
                addButton.disabled = entries.children.length >= 30;
                form.querySelector('[data-empty]').hidden = entries.children.length > 0;
            };

            form.addEventListener('click', event => {
                if (event.target.closest('[data-add-entry]')) {
                    const row = form.querySelector('template').content.cloneNode(true);
                    row.querySelectorAll('[data-entry-field]').forEach(input => {
                        input.name = 'items[' + nextIndex + '][' + input.dataset.entryField + ']';
                    });
                    const firstInput = row.querySelector('input');
                    entries.append(row);
                    nextIndex++;
                    refresh();
                    firstInput.focus();
                }

                const removeButton = event.target.closest('[data-remove-entry]');
                if (removeButton) {
                    removeButton.closest('fieldset').remove();
                    refresh();
                    addButton.focus();
                }
            });
            refresh();
        });
    </script>
</body>
</html>

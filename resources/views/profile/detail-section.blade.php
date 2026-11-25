<section id="{{ $key }}" aria-labelledby="{{ $key }}-title" class="scroll-mt-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
    <h2 id="{{ $key }}-title" class="text-xl font-bold tracking-tight">{{ $title }}</h2>

    @if ($detailsAvailable)
        @php
            $bag = $errors->getBag($key);
            $items = $bag->any() ? old('items', []) : ($details?->{$key} ?? []);
            $items = is_array($items) ? array_slice($items, 0, 30) : [];
        @endphp

        @if (session('profile_detail_status.'.$key))
            <p class="mt-3 text-sm font-medium text-emerald-800" role="status">{{ session('profile_detail_status.'.$key) }}</p>
        @endif
        @error('items', $key)
            <p class="mt-3 text-sm text-red-700" role="alert">{{ $message }}</p>
        @enderror

        <form method="POST" action="{{ route('jobseeker.profile.section', $key) }}" class="mt-4 space-y-4" data-profile-list>
            @csrf
            @method('PATCH')
            <p data-empty @if ($items !== []) hidden @endif class="text-sm text-slate-600">Belum ada data tersimpan.</p>
            <div class="space-y-3" data-entries>
                @foreach ($items as $index => $item)
                    @include('profile.detail-fields', ['entryIndex' => $index, 'entry' => $item])
                @endforeach
            </div>
            <template>
                @include('profile.detail-fields', ['entryIndex' => null, 'entry' => []])
            </template>
            <div class="grid gap-2 sm:flex">
                <button type="button" data-add-entry class="cursor-pointer rounded-xl border border-blue-200 px-5 py-3 text-sm font-semibold text-[#0062E3] hover:bg-blue-50 disabled:cursor-not-allowed disabled:opacity-50">Tambah entri</button>
                <button type="submit" class="cursor-pointer rounded-xl bg-[#0062E3] px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">Simpan {{ $title }}</button>
            </div>
        </form>
    @else
        <p class="mt-2 text-sm text-slate-600">Penyimpanan bagian ini belum tersedia di lingkungan ini.</p>
    @endif
</section>

<section id="cv" aria-labelledby="cv-title" class="scroll-mt-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
    <h2 id="cv-title" class="text-xl font-bold tracking-tight">CV</h2>

    @if ($detailsAvailable)
        @if (session('profile_detail_status.cv'))
            <p class="mt-3 text-sm font-medium text-emerald-800" role="status">{{ session('profile_detail_status.cv') }}</p>
        @endif
        @if ($details?->cv_path)
            <div class="mt-4 flex flex-wrap items-center gap-4 text-sm">
                <a href="{{ route('jobseeker.profile.cv.download') }}" class="font-semibold text-[#0062E3] hover:underline">Unduh CV tersimpan</a>
                <form method="POST" action="{{ route('jobseeker.profile.cv.delete') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cursor-pointer font-semibold text-red-700 hover:underline">Hapus CV</button>
                </form>
            </div>
        @else
            <p class="mt-2 text-sm text-slate-600">Belum ada CV yang diunggah.</p>
        @endif

        <form method="POST" action="{{ route('jobseeker.profile.cv.upload') }}" enctype="multipart/form-data" class="mt-5 space-y-3">
            @csrf
            <label for="cv-file" class="block text-sm font-semibold">{{ $details?->cv_path ? 'Pilih PDF pengganti' : 'Pilih berkas PDF' }}</label>
            <input id="cv-file" name="cv" type="file" accept=".pdf,application/pdf" required
                   aria-describedby="cv-help{{ $errors->cv->has('cv') ? ' cv-error' : '' }}"
                   @if ($errors->cv->has('cv')) aria-invalid="true" @endif
                   class="block w-full rounded-xl border border-slate-300 px-3 py-2 text-sm file:mr-3 file:cursor-pointer file:rounded-md file:bg-blue-50 file:px-3 file:py-2 file:font-medium file:text-[#0062E3]">
            <p id="cv-help" class="text-xs text-slate-600">PDF, maksimal 5 MB.</p>
            @error('cv', 'cv')
                <p id="cv-error" class="text-sm text-red-700" role="alert">{{ $message }}</p>
            @enderror
            <button type="submit" class="w-full cursor-pointer rounded-xl bg-[#0062E3] px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 sm:w-auto">{{ $details?->cv_path ? 'Ganti CV' : 'Unggah CV' }}</button>
        </form>
    @else
        <p class="mt-2 text-sm text-slate-600">Unggah, ganti, dan hapus CV belum tersedia di lingkungan ini.</p>
    @endif
</section>

<fieldset class="rounded-xl border border-slate-200 bg-slate-50 p-4">
    <legend class="sr-only">Entri {{ $title }}</legend>
    @if ($entryIndex !== null && $bag->has('items.'.$entryIndex))
        <p class="mb-3 text-sm text-red-700" role="alert">Format entri tidak valid.</p>
    @endif
    <div class="grid gap-3 sm:grid-cols-2">
        @foreach ($fields as $field => $label)
            @php
                $value = is_array($entry) ? ($entry[$field] ?? '') : '';
                $message = $entryIndex === null ? null : $bag->first('items.'.$entryIndex.'.'.$field);
                $errorId = $key.'-'.$entryIndex.'-'.$field.'-error';
            @endphp
            <div>
                <label class="block text-sm font-semibold">
                    {{ $label }} <span class="font-normal text-slate-600">(wajib)</span>
                    <input type="text" data-entry-field="{{ $field }}" required maxlength="160"
                           @if ($entryIndex !== null) name="items[{{ $entryIndex }}][{{ $field }}]" @endif
                           value="{{ is_string($value) ? $value : '' }}"
                           @if ($message) aria-invalid="true" aria-describedby="{{ $errorId }}" @endif
                           @class([
                               'mt-2 block w-full rounded-xl border bg-white px-3 py-2.5 text-sm focus:border-[#0062E3] focus:ring-blue-100',
                               'border-red-500' => $message,
                               'border-slate-300' => ! $message,
                           ])>
                </label>
                @if ($message)
                    <p id="{{ $errorId }}" class="mt-1 text-sm text-red-700" role="alert">{{ $message }}</p>
                @endif
            </div>
        @endforeach
    </div>
    <button type="button" data-remove-entry class="mt-3 cursor-pointer text-sm font-semibold text-red-700 hover:underline">Hapus entri</button>
</fieldset>

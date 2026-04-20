@php
    $decSep      = $effectiveDecimalSep();
    $thoSep      = $effectiveThousandsSep();
    $baseClasses = $baseClasses();
    $finalClass  = trim($baseClasses . ($class ? ' ' . $class : ''));
    $wireAttr    = $wireModel();    {{-- e.g. 'wire:model' | 'wire:model.live' | '' --}}
    $isLivewire  = (bool) $model;
@endphp

<input
    type="text"
    inputmode="decimal"

    {{-- ── Identity ─────────────────────────────────── --}}
    @if($id) id="{{ $id }}" @endif

    {{-- ── Classic Laravel form (name + value) ──────── --}}
    @if($name)
        name="{{ $name }}"
        value="{{ old($name, $formattedValue()) }}"
    @endif

    {{-- ── Livewire binding ──────────────────────────── --}}
    @if($isLivewire)
        {{ $wireAttr }}="{{ $model }}"
    @endif

    {{-- ── Misc attributes ───────────────────────────── --}}
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($required)    required @endif
    @if($disabled)    disabled @endif

    class="{{ $finalClass }}"

    {{-- ── Alpine.js keyboard + paste guard ─────────── --}}
    x-data
    x-on:keydown="
        const sep   = {{ json_encode($decSep) }};
        const tsep  = {{ json_encode($thoSep) }};
        const nav   = ['Backspace','Delete','ArrowLeft','ArrowRight','ArrowUp','ArrowDown','Tab','Home','End'];
        const digit = ['0','1','2','3','4','5','6','7','8','9'];
        const allowed = [...digit, sep, tsep, ...nav];

        if (!allowed.includes($event.key)) {
            $event.preventDefault();
            return;
        }

        // Allow only one decimal separator
        if ($event.key === sep && $event.target.value.includes(sep)) {
            $event.preventDefault();
        }
    "
    x-on:paste="
        const sep  = {{ json_encode($decSep) }};
        const tsep = {{ json_encode($thoSep) }};
        const text = $event.clipboardData.getData('text');
        const escaped = tsep.replace(/[.*+?^${}()|[\]\\\\]/g, '\\\\$&');
        const sepEsc   = sep.replace(/[.*+?^${}()|[\]\\\\]/g, '\\\\$&');
        const re = new RegExp('^[\\\\d' + escaped + sepEsc + ']+$');
        if (!re.test(text)) $event.preventDefault();
    "
/>

<?php

namespace Yourvendor\DecimalInput\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DecimalInput extends Component
{
    /**
     * @param string|null  $name         Form field name (classic Laravel forms)
     * @param string|null  $model        Livewire wire:model property
     * @param bool         $live         Whether to use wire:model.live instead of wire:model
     * @param mixed        $value        Initial value (used only with $name, not with $model)
     * @param int          $decimals     Number of decimal digits (default from config)
     * @param string       $decimalSep   Decimal separator (default from config, e.g. ',')
     * @param string       $thousandsSep Thousands separator (default from config, e.g. '.')
     * @param string|null  $class        Additional CSS classes (merged with base classes)
     * @param string|null  $style        'tailwind' | 'daisy' | 'none' — overrides config default
     * @param string|null  $id           HTML id attribute
     * @param bool         $required     Whether the field is required
     * @param bool         $disabled     Whether the field is disabled
     * @param string|null  $placeholder  Input placeholder text
     */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $model = null,
        public readonly bool $live = false,
        public readonly mixed $value = null,
        public readonly int $decimals = -1,
        public readonly string $decimalSep = '',
        public readonly string $thousandsSep = '',
        public readonly ?string $class = null,
        public readonly ?string $style = null,
        public readonly ?string $id = null,
        public readonly bool $required = false,
        public readonly bool $disabled = false,
        public readonly ?string $placeholder = null,
    ) {
    }

    /**
     * Resolve the effective number of decimal digits.
     */
    public function effectiveDecimals(): int
    {
        return $this->decimals >= 0
            ? $this->decimals
            : config('decimal-input.decimals', 2);
    }

    /**
     * Resolve the effective decimal separator.
     */
    public function effectiveDecimalSep(): string
    {
        return $this->decimalSep !== ''
            ? $this->decimalSep
            : config('decimal-input.decimal_separator', ',');
    }

    /**
     * Resolve the effective thousands separator.
     */
    public function effectiveThousandsSep(): string
    {
        return $this->thousandsSep !== ''
            ? $this->thousandsSep
            : config('decimal-input.thousands_separator', '.');
    }

    /**
     * Resolve which UI style to use.
     */
    public function effectiveStyle(): string
    {
        return $this->style ?? config('decimal-input.style', 'tailwind');
    }

    /**
     * Return base CSS classes for the resolved style.
     */
    public function baseClasses(): string
    {
        return match ($this->effectiveStyle()) {
            'tailwind'  => 'block w-full py-2 mt-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
            'bootstrap' => 'form-control',
            default     => '',  // 'none' — user provides all classes via $class
        };
    }

    /**
     * Format the initial value for display.
     */
    public function formattedValue(): string
    {
        if ($this->value === null || $this->value === '') {
            return '';
        }

        $numeric = is_numeric(
            str_replace([$this->effectiveThousandsSep(), $this->effectiveDecimalSep()], ['', '.'], (string) $this->value)
        )
            ? (float) str_replace([$this->effectiveThousandsSep(), $this->effectiveDecimalSep()], ['', '.'], (string) $this->value)
            : (float) $this->value;

        return number_format(
            $numeric,
            $this->effectiveDecimals(),
            $this->effectiveDecimalSep(),
            $this->effectiveThousandsSep()
        );
    }

    /**
     * Build the wire:model attribute string (or empty string for classic forms).
     */
    public function wireModel(): string
    {
        if (! $this->model) {
            return '';
        }

        return $this->live ? 'wire:model.live' : 'wire:model';
    }

    public function render(): View
    {
        return view('decimal-input::decimal-input');
    }
}

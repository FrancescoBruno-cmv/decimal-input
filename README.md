# laravel-decimal-input

A reusable Blade component for decimal number inputs with Alpine.js keyboard/paste filtering.  
Supports classic Laravel forms (`name`), Livewire (`wire:model`), and Livewire live binding (`wire:model.live`).  
Style is configurable: Tailwind CSS (default), Bootstrap, or unstyled.

---

## Requirements

- PHP 8.1+
- Laravel 10 / 11 / 12
- Alpine.js loaded in your layout (CDN or via npm)

---

## Installation

```bash
composer require yourvendor/laravel-decimal-input
```

The service provider is auto-discovered. No manual registration needed.

### Publish config (optional)

```bash
php artisan vendor:publish --tag=decimal-input-config
```

### Publish views for customisation (optional)

```bash
php artisan vendor:publish --tag=decimal-input-views
```

---

## Configuration

`config/decimal-input.php` (after publishing):

```php
return [
    'style'               => 'tailwind',   // 'tailwind' | 'bootstrap' | 'none'
    'decimals'            => 2,
    'decimal_separator'   => ',',          // Italian/EU: ','  —  US/UK: '.'
    'thousands_separator' => '.',          // Italian/EU: '.'  —  US/UK: ','
];
```

---

## Usage

### Classic Laravel form (name + value)

```blade
<x-decimal-input
    name="polizza"
    :value="old('polizza', number_format($preventivo?->polizza ?? 3, 2, ',', '.'))"
/>
```

### Livewire — lazy binding (default)

```blade
<x-decimal-input
    model="polizza"
/>
```

### Livewire — live / reactive binding

```blade
<x-decimal-input
    model="polizza"
    :live="true"
/>
```

---

## All Props

| Prop            | Type            | Default        | Description |
|-----------------|-----------------|----------------|-------------|
| `name`          | `string\|null`  | `null`         | HTML `name` attribute — use for classic forms |
| `model`         | `string\|null`  | `null`         | Livewire property name for `wire:model` |
| `live`          | `bool`          | `false`        | Use `wire:model.live` instead of `wire:model` |
| `value`         | `mixed`         | `null`         | Initial display value (only for `name` mode) |
| `decimals`      | `int`           | config (2)     | Number of decimal digits |
| `decimalSep`    | `string`        | config (`,`)   | Decimal separator character |
| `thousandsSep`  | `string`        | config (`.`)   | Thousands separator character |
| `style`         | `string\|null`  | config (`tailwind`) | `'tailwind'` \| `'bootstrap'` \| `'none'` |
| `class`         | `string\|null`  | `null`         | Extra CSS classes merged with base classes |
| `id`            | `string\|null`  | `null`         | HTML `id` attribute |
| `required`      | `bool`          | `false`        | Adds `required` attribute |
| `disabled`      | `bool`          | `false`        | Adds `disabled` attribute |
| `placeholder`   | `string\|null`  | `null`         | Placeholder text |

---

## Examples

### Bootstrap style

```blade
<x-decimal-input name="importo" :value="1234.50" style="bootstrap" />
```

### Unstyled (bring your own classes)

```blade
<x-decimal-input
    name="importo"
    style="none"
    class="my-custom-class px-4 py-2"
/>
```

### Override separators per-component (US style)

```blade
<x-decimal-input
    name="amount"
    :value="1234.56"
    decimalSep="."
    thousandsSep=","
/>
```

### Livewire with extra attributes

```blade
<x-decimal-input
    model="invoice.amount"
    :live="true"
    :decimals="4"
    id="amount-field"
    :required="true"
    placeholder="0,00"
    class="text-right"
/>
```

---

## License

MIT

# Decimal Input

[![Latest Version on Packagist](https://img.shields.io/packagist/v/francescobruno-cmv/decimal-input.svg?style=flat-square)](https://packagist.org/packages/francescobruno-cmv/decimal-input)
[![Total Downloads](https://img.shields.io/packagist/dt/francescobruno-cmv/decimal-input.svg?style=flat-square)](https://packagist.org/packages/francescobruno-cmv/decimal-input)
[![License](https://img.shields.io/packagist/l/francescobruno-cmv/decimal-input.svg?style=flat-square)](LICENSE.md)


Un componente Blade riutilizzabile per input numerici decimali con **Alpine.js** per il filtraggio da tastiera e da incolla.  
Compatibile con i form Laravel classici (`name`), **Livewire** (`wire:model`) e il binding reattivo **Livewire live** (`wire:model.live`).  
Lo stile è configurabile: **Tailwind CSS** (default), **Bootstrap**, o senza stile.

---

## ✨ Features

- ✅ Componente Blade pronto all'uso, zero configurazione obbligatoria
- 🎯 Compatibile con Laravel 10, 11 e 12
- ⚡ Integrazione nativa con **Livewire 3** (`wire:model` e `wire:model.live`)
- 🎨 Tre stili inclusi: **Tailwind CSS**, **Bootstrap**, o **unstyled**
- 🔢 Separatori decimali e delle migliaia configurabili (formato IT/EU e US/UK)
- ⌨️ Filtraggio input da tastiera e da incolla tramite **Alpine.js**
- 🔧 Config pubblicabile e viste personalizzabili

---

## 📦 Installazione

Installa il pacchetto tramite Composer:

```bash
composer require francescobruno-cmv/laravel-decimal-input
```

Il service provider viene registrato automaticamente. Nessuna configurazione manuale necessaria.

### Pubblica la configurazione (opzionale)

```bash
php artisan vendor:publish --tag=decimal-input-config
```

### Pubblica le viste per personalizzarle (opzionale)

```bash
php artisan vendor:publish --tag=decimal-input-views
```

## ⚙️ Requisiti

- PHP >= 8.1
- Laravel 10 / 11 / 12
- Alpine.js caricato nel layout (CDN o via npm)

---

## ⚙️ Configurazione

`config/decimal-input.php` (dopo la pubblicazione):

```php
return [
    'style'               => 'tailwind',   // 'tailwind' | 'bootstrap' | 'none'
    'decimals'            => 2,
    'decimal_separator'   => ',',          // IT/EU: ','  —  US/UK: '.'
    'thousands_separator' => '.',          // IT/EU: '.'  —  US/UK: ','
];
```

---

## 🚀 Utilizzo

### Form Laravel classico (`name` + `value`)

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

## 📋 Props disponibili

| Prop | Tipo | Default | Descrizione |
|---|---|---|---|
| `name` | `string\|null` | `null` | Attributo HTML `name` — per form classici |
| `model` | `string\|null` | `null` | Nome della proprietà Livewire per `wire:model` |
| `live` | `bool` | `false` | Usa `wire:model.live` al posto di `wire:model` |
| `value` | `mixed` | `null` | Valore iniziale (solo in modalità `name`) |
| `decimals` | `int` | config (2) | Numero di cifre decimali |
| `decimalSep` | `string` | config (`,`) | Separatore decimale |
| `thousandsSep` | `string` | config (`.`) | Separatore delle migliaia |
| `style` | `string\|null` | config (`tailwind`) | `'tailwind'` \| `'bootstrap'` \| `'none'` |
| `class` | `string\|null` | `null` | Classi CSS aggiuntive |
| `id` | `string\|null` | `null` | Attributo HTML `id` |
| `required` | `bool` | `false` | Aggiunge l'attributo `required` |
| `disabled` | `bool` | `false` | Aggiunge l'attributo `disabled` |
| `placeholder` | `string\|null` | `null` | Testo placeholder |

---

## 📝 Esempi

### Stile Bootstrap

```blade
<x-decimal-input name="importo" :value="1234.50" style="bootstrap" />
```

### Senza stile (classi personalizzate)

```blade
<x-decimal-input
    name="importo"
    style="none"
    class="my-custom-class px-4 py-2"
/>
```

### Separatori in formato US per componente

```blade
<x-decimal-input
    name="amount"
    :value="1234.56"
    decimalSep="."
    thousandsSep=","
/>
```

### Livewire con attributi aggiuntivi

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

## 🤝 Contributi

Le contribuzioni sono benvenute!

1. Fai fork del progetto
2. Crea un branch (`feature/nome-feature`)
3. Commit delle modifiche
4. Push sul branch
5. Apri una Pull Request

---

## 📄 Licenza

Questo pacchetto è distribuito sotto licenza MIT.  
Vedi il file `LICENSE.md` per maggiori dettagli.

---

## 👤 Autore

**Francesco Bruno**

---

## ⭐ Supporto

Se il pacchetto ti è utile, lascia una ⭐ su GitHub!

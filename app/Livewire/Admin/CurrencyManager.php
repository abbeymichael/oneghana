<?php

namespace App\Livewire\Admin;

use App\Models\Currency;
use Livewire\Component;

class CurrencyManager extends Component
{
    public bool $showForm = false;
    public ?int $editingCurrencyId = null;
    public string $code = '';
    public string $symbol = '';
    public string $name = '';
    public bool $is_active = true;
    public bool $is_default = false;

    public function create() { $this->resetForm(); $this->showForm = true; $this->editingCurrencyId = null; }

    public function edit(Currency $currency)
    {
        $this->resetForm(); $this->showForm = true;
        $this->editingCurrencyId = $currency->id;
        $this->code = $currency->code; $this->symbol = $currency->symbol;
        $this->name = $currency->name; $this->is_active = $currency->is_active; $this->is_default = $currency->is_default;
    }

    public function save()
    {
        $this->validate([
            'code' => ['required', 'string', 'max:3'],
            'symbol' => ['required', 'string', 'max:10'],
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['boolean'], 'is_default' => ['boolean'],
        ]);

        $data = ['code' => strtoupper($this->code), 'symbol' => $this->symbol, 'name' => $this->name, 'is_active' => $this->is_active, 'is_default' => $this->is_default];
        $this->editingCurrencyId ? Currency::findOrFail($this->editingCurrencyId)->update($data) : Currency::create($data);
        session()->flash('message', 'Currency saved!');
        $this->showForm = false; $this->resetForm();
    }

    public function toggleActive(Currency $currency) { $currency->update(['is_active' => !$currency->is_active]); }

    public function setDefault(Currency $currency) { Currency::where('is_default', true)->update(['is_default' => false]); $currency->update(['is_default' => true]); }

    public function delete(Currency $currency)
    {
        if ($currency->is_default) { session()->flash('error', 'Cannot delete default currency.'); return; }
        $currency->delete(); session()->flash('message', 'Currency deleted.');
    }

    private function resetForm(): void { $this->code = ''; $this->symbol = ''; $this->name = ''; $this->is_active = true; $this->is_default = false; }

    public function render()
    {
        return view('livewire.admin.currency-manager', ['currencies' => Currency::all()])->layout('layouts.app');
    }
}

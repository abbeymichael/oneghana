<?php

namespace App\Livewire\Owner;

use App\Models\Business;
use App\Models\Currency;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductManager extends Component
{
    use WithFileUploads;

    public Business $business;
    public bool $showForm = false;
    public ?int $editingProductId = null;

    public string $name = '';
    public string $description = '';
    public ?string $price = null;
    public ?string $currency_id = null;
    public string $unit = '';
    public string $type = 'product';
    public bool $is_available = true;
    public $photo = null;

    public function mount(Business $business)
    {
        if ($business->user_id !== auth()->id() && !auth()->user()->isAdmin()) abort(403);
        $this->business = $business;
    }

    public function create() { $this->resetForm(); $this->showForm = true; $this->editingProductId = null; }

    public function edit(Product $product)
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingProductId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description ?? '';
        $this->price = (string) $product->price;
        $this->currency_id = (string) $product->currency_id;
        $this->unit = $product->unit ?? '';
        $this->type = $product->type;
        $this->is_available = $product->is_available;
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
            'unit' => ['nullable', 'string', 'max:100'],
            'type' => ['required', 'in:product,service'],
            'is_available' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:5120'],
        ]);

        $data = [
            'business_id' => $this->business->id,
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'currency_id' => $this->currency_id ?: Currency::default()?->id,
            'unit' => $this->unit,
            'type' => $this->type,
            'is_available' => $this->is_available,
        ];

        $product = $this->editingProductId
            ? tap(Product::findOrFail($this->editingProductId))->update($data)
            : Product::create($data);

        if ($this->photo) { $product->clearMediaCollection('product_photos'); $product->addMedia($this->photo)->toMediaCollection('product_photos'); }

        session()->flash('message', $this->editingProductId ? 'Product updated!' : 'Product added!');
        $this->showForm = false;
        $this->resetForm();
    }

    public function delete(Product $product) { $product->delete(); session()->flash('message', 'Product removed.'); }

    private function resetForm(): void
    {
        $this->name = ''; $this->description = ''; $this->price = null;
        $this->currency_id = (string) (Currency::default()?->id ?? '');
        $this->unit = ''; $this->type = 'product'; $this->is_available = true; $this->photo = null;
    }

    public function render()
    {
        return view('livewire.owner.product-manager', [
            'products' => $this->business->products()->with('currency')->orderBy('sort_order')->get(),
            'currencies' => Currency::active()->get(),
        ])->layout('layouts.app');
    }
}

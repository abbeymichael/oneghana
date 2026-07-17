<?php

namespace App\Livewire;

use App\Models\Business;
use App\Models\Category;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class BusinessSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $category = null;
    public ?string $region = null;
    public ?string $district = null;
    public ?int $minRating = null;
    public string $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'region' => ['except' => ''],
        'district' => ['except' => ''],
        'minRating' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingCategory() { $this->resetPage(); }
    public function updatingRegion() { $this->district = null; $this->resetPage(); }

    public function render()
    {
        $query = Business::published()->with(['category', 'region', 'district']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
                  ->orWhere('address_text', 'like', "%{$this->search}%");
            });
        }

        if ($this->category) {
            $categoryModel = Category::where('slug', $this->category)->first();
            if ($categoryModel) {
                $categoryIds = $categoryModel->children()->pluck('id')->push($categoryModel->id);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($this->region) {
            $query->whereHas('region', fn($q) => $q->where('name', $this->region));
        }

        if ($this->district) {
            $query->whereHas('district', fn($q) => $q->where('name', $this->district));
        }

        $query->when($this->sort === 'latest', fn($q) => $q->latest())
              ->when($this->sort === 'name', fn($q) => $q->orderBy('name'))
              ->when($this->sort === 'views', fn($q) => $q->orderBy('views_count', 'desc'));

        $businesses = $query->paginate(12);
        $categories = Category::root()->with('children')->get();
        $regions = Region::with('districts')->get();
        $selectedRegion = $this->region ? Region::where('name', $this->region)->first() : null;

        return view('livewire.business-search', compact('businesses', 'categories', 'regions', 'selectedRegion'))->layout('layouts.app');
    }
}

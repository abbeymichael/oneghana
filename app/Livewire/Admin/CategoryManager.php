<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class CategoryManager extends Component
{
    public bool $showForm = false;
    public ?int $editingCategoryId = null;
    public string $name = '';
    public ?string $parent_id = null;
    public string $icon = '';
    public string $custom_fields_schema = '';

    public function create() { $this->resetForm(); $this->showForm = true; $this->editingCategoryId = null; }

    public function edit(Category $category)
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingCategoryId = $category->id;
        $this->name = $category->name;
        $this->parent_id = (string) $category->parent_id;
        $this->icon = $category->icon ?? '';
        $this->custom_fields_schema = $category->custom_fields_schema ? json_encode($category->custom_fields_schema, JSON_PRETTY_PRINT) : '';
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'icon' => ['nullable', 'string', 'max:255'],
            'custom_fields_schema' => ['nullable', 'json'],
        ]);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'parent_id' => $this->parent_id ?: null,
            'icon' => $this->icon ?: null,
            'custom_fields_schema' => $this->custom_fields_schema ? json_decode($this->custom_fields_schema, true) : null,
        ];

        $this->editingCategoryId ? Category::findOrFail($this->editingCategoryId)->update($data) : Category::create($data);
        session()->flash('message', 'Category saved!');
        $this->showForm = false;
        $this->resetForm();
    }

    public function delete(Category $category)
    {
        if ($category->children()->exists() || $category->businesses()->exists()) {
            session()->flash('error', 'Cannot delete category with subcategories or businesses.');
            return;
        }
        $category->delete();
        session()->flash('message', 'Category deleted.');
    }

    private function resetForm(): void { $this->name = ''; $this->parent_id = null; $this->icon = ''; $this->custom_fields_schema = ''; }

    public function render()
    {
        return view('livewire.admin.category-manager', [
            'categories' => Category::root()->with('children')->get(),
            'parentCategories' => Category::root()->get(),
        ])->layout('layouts.app');
    }
}

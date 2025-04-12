<?php

namespace App\Http\Livewire;

use App\Models\Master;
use App\Models\Detail;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MasterDetailsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Master $master;
    public Detail $detail;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModalView = false;
    public $showingModalForm = false;

    public $modalTitle = 'New Detail';

    protected $rules = [
        'detail.label' => ['required', 'max:255', 'string'],
    ];

    public function mount(Master $master): void
    {
        $this->master = $master;
        $this->resetDetailData();
    }

    public function resetDetailData(): void
    {
        $this->detail = new Detail();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newDetail(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.master_details.new_title');
        $this->resetDetailData();

        $this->showModalForm();
    }

    public function viewDetail(Detail $detail): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.master_details.show_title');
        $this->detail = $detail;

        $this->dispatchBrowserEvent('refresh');

        $this->showModalView();
    }

    public function editDetail(Detail $detail): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.master_details.edit_title');
        $this->detail = $detail;

        $this->dispatchBrowserEvent('refresh');

        $this->showModalForm();
    }

    public function showModalView(): void
    {
        $this->resetErrorBag();
        $this->showingModalView = true;
        $this->showingModalForm = false;
    }

    public function showModalForm(): void
    {
        $this->resetErrorBag();
        $this->showingModalView = false;
        $this->showingModalForm = true;
    }

    public function hideModal(): void
    {
        $this->showingModalView = false;
        $this->showingModalForm = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->detail->master_id) {
            $this->authorize('create', Detail::class);

            $this->detail->master_id = $this->master->id;
        } else {
            $this->authorize('update', $this->detail);
        }

        $this->detail->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Detail::class);

        Detail::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetDetailData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->master->details as $detail) {
            array_push($this->selected, $detail->id);
        }
    }

    public function render(): View
    {
        return view('livewire.master-details-detail', [
            'details' => $this->master->details()->paginate(100),
        ]);
    }
}

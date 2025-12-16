<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Region;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BillList extends Component
{
    use WithPagination;
    protected $listeners = [
        'toggleRegion' => 'handleToggle',
        'statusChanged' => 'handleStatus',
        'cityChanged' => 'handleCity',
        'categoryChanged' => 'handleCategory',
        'category_list_changed' => 'refresh_bill_list',
        'bill_status_updated' => 'update_bill_status',
        'bill_deleted' => 'delete_bill'
    ];

    public $filters;

    public function handleToggle($payload)
    {
        if ($payload['selected']) {
            $this->filters['selectedRegions'][] = $payload['value'];
        } else {
            $value = $payload['value'];
            $key = array_search($value, array_map('strval', $this->filters['selectedRegions']));
            if ($key !== false) {
                unset($this->filters['selectedRegions'][$key]);
                $this->filters['selectedRegions'] = array_values($this->filters['selectedRegions']);
            }
        }
        $this->render();
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
    }

    public function displayModal($bill_id)
    {
        $this->dispatch('display_modal', ['bill_id' => $bill_id]);
    }

    public function displayNoteModal($bill_id)
    {
        $this->dispatch('display_note_modal', ['bill_id' => $bill_id]);
    }

    public function handleStatus($payload)
    {
        $this->filters['selectedStatus'] = $payload['statusValue'];
        $this->render();
    }

    public function handleCity($payload)
    {
        $this->filters['selectedCity'] = $payload['cityValue'];
        $this->render();
    }

    public function handleCategory($payload)
    {
        $this->filters['selectedCategory'] = $payload['categoryValue'];
        $this->render();
    }

    public function displayBills($filters, $sortField, $sortType)
    {
        $bills = Bill::withTrashed()
            ->with([
                'invoice_template' => function ($q) {
                    $q->withTrashed();
                },
                'invoice_template.due_day',
                'invoice_template.invoice_for_attention',
                'invoice_template.city',
                'invoice_template.category',
                'invoice_template.region',
                'invoice_template.user',
                'status',
                'status.company'
            ]);

        $bills = $bills->whereHas('invoice_template', function ($q) use ($filters) {
            $q->withTrashed()->whereHas('region', function ($query) use ($filters) {
                $query->whereIn('name', $filters['selectedRegions']);
            });
        });

        if ($filters['selectedStatus'] !== 'All') {
            $bills = $bills->withTrashed()->whereHas('status', function ($query) use ($filters) {
                $query->where('name', $filters['selectedStatus']);
            });
        }
        if ($filters['selectedCity'] !== 'All') {
            $bills = $bills->whereHas('invoice_template', function ($q) use ($filters) {
                $q->withTrashed()->whereHas('city', function ($query) use ($filters) {
                    $query->where('name', $filters['selectedCity']);
                });
            });
        }
        if ($filters['selectedCategory'] !== 'All') {
            $bills = $bills->whereHas('invoice_template', function ($q) use ($filters) {
                $q->withTrashed()->whereHas('category', function ($query) use ($filters) {
                    $query->where('name', $filters['selectedCategory']);
                });
            });
        }

        if ($sortField == 'assignee') {
            $bills = $bills
                ->orderByRaw($sortField, $sortType);
        } else {
            $bills = $bills
                ->orderBy($sortField, $sortType);
        }

        $bills = $bills->paginate(5);
        return view('livewire.bill-list', [
            'bills' => $bills
        ]);
    }


    public function render()
    {
        return $this->displayBills($this->filters, 'bills.created_at', 'desc');
    }

    public function update_bill_status($payload)
    {
        $bill = Bill::where('id', $payload['bill_id'])->first();
        $bill->status_id = $payload['status'];
        $bill->save();
    }

    public function delete_bill($payload)
    {
        $bill = Bill::where('id', $payload['bill_id'])->first();
        $bill->delete();
    }

    public function mount()
    {
        $this->filters = [
            'selectedRegions' => Region::where('selected', true)->pluck('name')->toArray(),
            'selectedStatus' => 'All',
            'selectedCity' => 'All',
            'selectedCategory' => 'All'
        ];
    }
}

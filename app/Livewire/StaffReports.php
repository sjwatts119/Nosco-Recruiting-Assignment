<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class StaffReports extends Component
{
    public Collection $staff;

    public $dateRange = 'all-time';
    public $sortField = 'id';
    public $sortDescending = true;

    public function mount(): void
    {
        $this->loadStaff();
    }

    public function selectDateRange($range): void
    {
        $this->dateRange = $range;
        $this->loadStaff();
    }

    public function sortBy($field): void
    {
        // If the sort field is the same, toggle the sorting direction
        if ($this->sortField === $field) {
            $this->sortDescending = !$this->sortDescending;
        } else {
            $this->sortField = $field;
            $this->sortDescending = true;
        }

        // Re-load staff with new sort order
        $this->loadStaff();
    }

    public function getDateRangedAgreementData($staff): Collection
    {
        // For each user, we need to calculate the metrics required for the table
        return $staff->map(function ($user) {
            // Total number of purchase agreements
            $agreementsCount = $user->agreements->count();

            // Total number of agreement items across all agreements
            $totalItems = $user->agreements->sum(function ($agreement) {
                return $agreement->agreementItems->count();
            });

            // Total cost price of all agreement items accounting for quantities
            $totalCostPrice = $user->agreements->sum(function ($agreement) {
                return $agreement->getTotalCostPrice();
            });

            // Average cost price of agreement items
            $averageCostPrice = $totalItems > 0 ? $totalCostPrice / $totalItems : 0;

            // Maximum cost price of any single agreement item
            $maxCostPrice = $user->agreements->flatMap(function ($agreement) {
                return $agreement->agreementItems;
            })->max('cost_price');

            // Return an object with the required data for the table row
            return (object)[
                'id' => $user->id,
                'name' => $user->name,
                'agreements_count' => $agreementsCount,
                'total_items' => $totalItems,
                'total_cost_price' => $totalCostPrice,
                'average_cost_price' => $averageCostPrice,
                'max_cost_price' => $maxCostPrice,
            ];
        });
    }

    public function sort($staff): Collection
    {
        // Sort the staff collection based on the sortField and sortDirection
        return $staff->sortBy($this->sortField, SORT_REGULAR, $this->sortDescending);
    }

    public function loadStaff(): void
    {
        // Get the date range from the user selected filtering range
        if ($this->dateRange === 'last-month') {
            $dateRange = [now()->subMonth(), now()];
        } else if ($this->dateRange === 'last-year') {
            $dateRange = [now()->subYear(), now()];
        } else {
            $dateRange = null;
        }

        // Get all staff users with their agreements and agreement items, but only within the date range
        $this->staff = User::with(['agreements' => function ($query) use ($dateRange) {
            // Apply date range filtering to the agreements
            if ($dateRange) {
                $query->whereBetween('created_at', $dateRange);
            }
        }, 'agreements.agreementItems'])->get();

        // Get the required metrics for each user
        $this->staff = $this->getDateRangedAgreementData($this->staff);

        // Sort the staff collection based on the sortField and sortDirection
        $this->staff = $this->sort($this->staff);
    }

    public function render(): View
    {
        return view('livewire.staff-reports');
    }
}

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

    /**
     * When mounting, load the staff data.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->loadStaff();
    }

    /**
     * When the user selects a date range, update the date range value and reload the staff data.
     *
     * @param $range
     *
     * @return void
     */
    public function selectDateRange($range): void
    {
        $this->dateRange = $range;
        $this->loadStaff();
    }

    /**
     * Sort the staff data by the selected field. If the field is the same as the current sort field, toggle the sort direction.
     *
     * @param $field
     *
     * @return void
     */
    public function sortBy($field): void
    {
        // If the sort field is the same, toggle the sorting direction
        if ($this->sortField === $field) {
            $this->sortDescending = !$this->sortDescending;
        } else {
            $this->sortField = $field;
            $this->sortDescending = true;
        }

        $this->loadStaff();
    }

    /**
     * Calculate the required data for each user within the date range.
     *
     * @param $staff
     *
     * @return Collection
     */
    public function getDateRangedAgreementData($staff): Collection
    {
        // For each user, calculate the metrics required for the table
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

    /**
     * Sort the staff collection based on the sortField and sortDirection.
     *
     * @param $staff
     *
     * @return Collection
     */
    public function sort($staff): Collection
    {
        // Sort the staff collection based on the sortField and sortDirection
        return $staff->sortBy($this->sortField, SORT_REGULAR, $this->sortDescending);
    }

    /**
     * Load the staff data based on the selected date range. If no date range is selected, load all staff data.
     * The staff data is then sorted based on the selected sort field and direction.
     * The staff data is then updated in the staff property.
     *
     * @return void
     */
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

        $this->staff = $this->getDateRangedAgreementData($this->staff);

        $this->staff = $this->sort($this->staff);
    }

    public function render(): View
    {
        return view('livewire.staff-reports');
    }
}

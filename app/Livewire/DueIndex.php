<?php

namespace App\Livewire;

use App\Models\Due;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DueIndex extends Component
{
    use WithPagination;
    public $filter_due = 'todays';

    public function render()
    {
        // $query = Due::with('user', 'sale', 'customer');
        $dues = Due::whereDate('created_at', Carbon::today()->toDateString())->paginate(7);
        if ($this->filter_due == 'todays') {
            $dues = Due::whereDate('created_at', Carbon::today()->toDateString())->paginate(7);
        }
        if ($this->filter_due == 'week') {
            $s_Week = Carbon::now()->startOfWeek();
            $e_Week = Carbon::now()->endOfWeek();
            $dues = Due::whereBetween('created_at', [$s_Week, $e_Week])->paginate(7);
        }
        if ($this->filter_due == 'month') {
            $dues = Due::whereMonth('created_at', Carbon::now()->month)->paginate(7);
        }
        if ($this->filter_due == '') {
            $dues = Due::paginate(7);
        }
        return view('pages.due-index', compact('dues'));
    }
}

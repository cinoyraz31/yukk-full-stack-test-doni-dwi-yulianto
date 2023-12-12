<?php

namespace App\Services\Transaction;
use App\Models\Transaction;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class IndexService extends BaseService
{
    public $rules = [
        'per_page' => 'nullable|numeric',
    ];

    public $ruleMessages = [
        'per_page.numeric' => 'per page must numeric',
    ];

    public function constructAdapter()
    {
        $this->request['per_page'] = !empty($this->request['per_page']) ? $this->request['per_page'] : '5';
    }

    public function execute()
    {
        $search = !empty($this->request["search"]) ? $this->request["search"] : null;
        $this->data = Transaction::where('user_id', Auth::id())
            ->when($search, function($query, $search){
                $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate($this->request['per_page']);
    }
}

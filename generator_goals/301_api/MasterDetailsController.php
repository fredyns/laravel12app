<?php

namespace App\Http\Controllers\Api;

use App\Models\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailResource;
use App\Http\Resources\DetailCollection;

class MasterDetailsController extends Controller
{
    public function index(Request $request, Master $master): DetailCollection
    {
        $this->authorize('view', $master);

        $search = (string) $request->get('search', '');

        $details = $master
            ->details()
            ->search($search)
            ->latest()
            ->paginate(10);

        return new DetailCollection($details);
    }

    public function store(Request $request, Master $master): DetailResource
    {
        $this->authorize('create', Detail::class);

        $validated = $request->validate([
            'label' => ['required', 'max:255', 'string'],
        ]);

        $detail = $master->details()->create($validated);

        return new DetailResource($detail);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MasterResource;
use App\Http\Resources\MasterCollection;
use fredyns\stringcleaner\StringCleaner;
use App\Http\Requests\MasterStoreRequest;
use App\Http\Requests\MasterUpdateRequest;

class MasterController extends Controller
{
    public function index(Request $request): MasterCollection
    {
        $this->authorize('view-any', Master::class);

        $search = (string) $request->get('search', '');

        if (!$search or $search == 'null') {
            $search = '';
        }

        $masters = Master::search($search)
            ->latest()
            ->paginate(10);

        return new MasterCollection($masters);
    }

    public function store(MasterStoreRequest $request): MasterResource
    {
        $this->authorize('create', Master::class);

        $validated = $request->validated();

        $master = Master::create($validated);

        return new MasterResource($master);
    }

    public function show(Request $request, Master $master): MasterResource
    {
        $this->authorize('view', $master);

        return new MasterResource($master);
    }

    public function update(
        MasterUpdateRequest $request,
        Master $master
    ): MasterResource {
        $this->authorize('update', $master);

        $validated = $request->validated();

        $master->update($validated);

        return new MasterResource($master);
    }

    public function destroy(Request $request, Master $master): Response
    {
        $this->authorize('delete', $master);

        $master->delete();

        return response()->noContent();
    }
}

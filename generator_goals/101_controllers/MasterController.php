<?php


use App\Http\Requests\MasterStoreRequest;
use App\Http\Requests\MasterUpdateRequest;
use App\Models\Master;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MasterController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Master::class);

        $search = (string) $request->get('search', '');

        if (!$search or $search == 'null') {
            $search = '';
        }

        $masters = Master::search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('app.masters.index', compact('masters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Master::class);

        return view('app.masters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Master::class);

        $validated = $request->validated();

        $master = Master::create($validated);

        return redirect()
            ->route('masters.show', $master)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Master $master): View
    {
        $this->authorize('view', $master);

        return view('app.masters.show', compact('master'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Master $master): View
    {
        $this->authorize('update', $master);

        return view('app.masters.edit', compact('master'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MasterUpdateRequest $request,
        Master $master
    ): RedirectResponse {
        $this->authorize('update', $master);

        $validated = $request->validated();

        $master->update($validated);

        return redirect()
            ->route('masters.show', $master)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Master $master): RedirectResponse
    {
        $this->authorize('delete', $master);

        $master->delete();

        return redirect()
            ->route('masters.index')
            ->withSuccess(__('crud.common.removed'));
    }
}

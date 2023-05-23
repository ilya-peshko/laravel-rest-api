<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\InvoiceStoreRequest;
use App\Http\Requests\V1\InvoiceUpdateRequest;
use App\Http\Requests\V1\InvoiceBulkStoreRequest;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invoicesCollection = new InvoiceCollection(Invoice::paginate(10));

        return response()->json([
            'data' => $invoicesCollection->all(),
            'meta' => [
                'currentPage' => $invoicesCollection->currentPage(),
                'lastPage'    => $invoicesCollection->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceStoreRequest $request): InvoiceResource
    {
        return new InvoiceResource(Invoice::create($request->all()));
    }

    public function bulkStore(InvoiceBulkStoreRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });

        Invoice::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): InvoiceResource
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice): InvoiceResource
    {
        return new InvoiceResource(Invoice::update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $isDestroyed = Invoice::destroy($invoice->id);

        return response()->json([
            'status' => $isDestroyed ? 'success' : 'error',
        ]);
    }
}

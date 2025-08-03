<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockIn;
use App\Models\Product;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['stockIns'] = StockIn::with('product')->orderBy('date', 'desc')->get();
        return view('stock-in.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::all();
        return view('stock-in.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'supplier' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $input = $request->all();
        StockIn::create($input);

        // Update product stock
        $product = Product::find($request->product_id);
        $product->current_stock += $request->quantity;
        $product->save();

        alert()->success('Data barang masuk berhasil disimpan', 'Berhasil');
        return redirect('stock-in');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['stockIn'] = StockIn::with('product')->find($id);
        return view('stock-in.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['stockIn'] = StockIn::find($id);
        $data['products'] = Product::all();
        return view('stock-in.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'supplier' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $stockIn = StockIn::find($id);
        $oldQuantity = $stockIn->quantity;
        $oldProductId = $stockIn->product_id;

        $input = $request->all();
        $stockIn->update($input);

        // Update product stock
        if ($oldProductId == $request->product_id) {
            // Same product, adjust stock difference
            $product = Product::find($request->product_id);
            $product->current_stock = $product->current_stock - $oldQuantity + $request->quantity;
            $product->save();
        } else {
            // Different product, update both
            $oldProduct = Product::find($oldProductId);
            $oldProduct->current_stock -= $oldQuantity;
            $oldProduct->save();

            $newProduct = Product::find($request->product_id);
            $newProduct->current_stock += $request->quantity;
            $newProduct->save();
        }

        alert()->success('Data barang masuk berhasil diubah', 'Berhasil');
        return redirect('stock-in');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stockIn = StockIn::find($id);
        
        // Update product stock
        $product = Product::find($stockIn->product_id);
        $product->current_stock -= $stockIn->quantity;
        $product->save();

        $stockIn->delete();

        alert()->success('Data barang masuk berhasil dihapus', 'Berhasil');
        return redirect('stock-in');
    }

    public function delete(Request $request)
    {
        $stockIn = StockIn::find($request->id);
        
        // Update product stock
        $product = Product::find($stockIn->product_id);
        $product->current_stock -= $stockIn->quantity;
        $product->save();

        $stockIn->delete();

        return 'success';
    }
}

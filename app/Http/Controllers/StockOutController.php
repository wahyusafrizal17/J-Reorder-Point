<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockOut;
use App\Models\Product;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['stockOuts'] = StockOut::with('product')->orderBy('date', 'desc')->get();
        return view('stock-out.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['products'] = Product::all();
        return view('stock-out.create', $data);
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
            'customer' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Check if stock is sufficient
        $product = Product::find($request->product_id);
        if ($product->current_stock < $request->quantity) {
            alert()->error('Stok tidak mencukupi', 'Error');
            return back()->withInput();
        }

        $input = $request->all();
        StockOut::create($input);

        // Update product stock
        $product->current_stock -= $request->quantity;
        $product->save();

        alert()->success('Data barang keluar berhasil disimpan', 'Berhasil');
        return redirect('stock-out');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['stockOut'] = StockOut::with('product')->find($id);
        return view('stock-out.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['stockOut'] = StockOut::find($id);
        $data['products'] = Product::all();
        return view('stock-out.edit', $data);
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
            'customer' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $stockOut = StockOut::find($id);
        $oldQuantity = $stockOut->quantity;
        $oldProductId = $stockOut->product_id;

        // Check if stock is sufficient for new quantity
        $product = Product::find($request->product_id);
        $availableStock = $product->current_stock + $oldQuantity; // Add back the old quantity
        if ($availableStock < $request->quantity) {
            alert()->error('Stok tidak mencukupi', 'Error');
            return back()->withInput();
        }

        $input = $request->all();
        $stockOut->update($input);

        // Update product stock
        if ($oldProductId == $request->product_id) {
            // Same product, adjust stock difference
            $product->current_stock = $product->current_stock + $oldQuantity - $request->quantity;
            $product->save();
        } else {
            // Different product, update both
            $oldProduct = Product::find($oldProductId);
            $oldProduct->current_stock += $oldQuantity;
            $oldProduct->save();

            $newProduct = Product::find($request->product_id);
            $newProduct->current_stock -= $request->quantity;
            $newProduct->save();
        }

        alert()->success('Data barang keluar berhasil diubah', 'Berhasil');
        return redirect('stock-out');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stockOut = StockOut::find($id);
        
        // Update product stock
        $product = Product::find($stockOut->product_id);
        $product->current_stock += $stockOut->quantity;
        $product->save();

        $stockOut->delete();

        alert()->success('Data barang keluar berhasil dihapus', 'Berhasil');
        return redirect('stock-out');
    }

    public function delete(Request $request)
    {
        $stockOut = StockOut::find($request->id);
        
        // Update product stock
        $product = Product::find($stockOut->product_id);
        $product->current_stock += $stockOut->quantity;
        $product->save();

        $stockOut->delete();

        return 'success';
    }
}

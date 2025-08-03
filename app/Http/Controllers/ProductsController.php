<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::all();
        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'product_code' => 'required|unique:products,product_code',
            'name' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'reorder_point' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $input = $request->all();
        $input['current_stock'] = 0;
        Product::create($input);

        alert()->success('Data barang berhasil disimpan', 'Berhasil');
        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = Product::find($id);
        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::find($id);
        return view('products.edit', $data);
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
            'product_code' => 'required|unique:products,product_code,' . $id,
            'name' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'reorder_point' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $model = Product::find($id);
        $input = $request->all();
        $model->update($input);

        alert()->success('Data barang berhasil diubah', 'Berhasil');
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Product::find($id);
        $model->delete();

        alert()->success('Data barang berhasil dihapus', 'Berhasil');
        return redirect('products');
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();

        return 'success';
    }
}

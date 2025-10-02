<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\TransactionDetail;

class InventoryObeserver
{
    /**
     * Handle the Inventory "created" event.
     */
    public function created(Inventory $inventory): void
    {
        $this->updateStock($inventory);
    }

    /**
     * Handle the Inventory "updated" event.
     */
    public function updated(Inventory $inventory): void
    {
        $this->updateStock($inventory);
    }

    /**
     * Handle the Inventory "deleted" event.
     */
    public function deleted(Inventory $inventory): void
    {
        $this->updateStock($inventory);
    }

    /**
     * Handle the Inventory "restored" event.
     */
    public function restored(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "force deleted" event.
     */
    public function forceDeleted(Inventory $inventory): void
    {
        //
    }

    private function updateStock(Inventory $inventory)
    {
        $product = Product::find($inventory->product_id);
        $productSell = TransactionDetail::where('product_id', $inventory->product_id)->sum('qty') ?? 0;
        if ($product) {
            $totalStock = $product->inventories()->sum('qty') - $productSell;
            $product->stock = $totalStock;
            $product->save();
        }
    }
}

<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Product;

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
        if ($product) {
            $totalStock = $product->inventories()->sum('qty');
            $product->stock = $totalStock;
            $product->save();
        }
        $totalStock = $product->inventories()->sum('qty');
        $product->stock = $totalStock;
        $product->save();
    }
}

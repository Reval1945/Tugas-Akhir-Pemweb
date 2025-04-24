<?php

namespace App\Imports;

use App\Models\Wishlist;
use Maatwebsite\Excel\Concerns\ToModel;

class WishlistImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Define the expected header values
        $expectedHeader = ['kode_wishlist', 'nama_wishlist', 'link_olshop', 'target_beli'];

        // Skip the header row
        if ($row === $expectedHeader) {
            return null;
        }

        // Return new Wishlist model with the row data
        return new Wishlist([
            'kode_wishlist' => $row[0],
            'nama_wishlist' => $row[1],
            'link_olshop' => $row[2],
            'target_beli' => $row[3],
        ]);
    }
}

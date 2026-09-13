<?php

namespace App\Services;

use InvalidArgumentException;

class FarmingSystemAnalysis
{
    /**
     * Menghitung harga minimal komoditas unggulan
     * berdasarkan rumus Farming System Analysis (FSA).
     *
     * Rumus:
     * hi = (ei + d0) / t0
     *
     * Keterangan:
     * ei = Keuntungan komoditas pembanding (Rp/ha)
     * d0 = Biaya produksi komoditas unggulan (Rp/ha)
     * t0 = Produksi komoditas unggulan (Kg/ha)
     * hi = Harga minimal komoditas unggulan (Rp/Kg)
     */
    public function hitungHargaMinimal(
        float $keuntunganEi,
        float $biayaProduksiD0,
        float $produksiT0
    ): float {
        // Produksi tidak boleh 0 atau negatif
        // karena digunakan sebagai pembagi.
        if ($produksiT0 <= 0) {
            throw new InvalidArgumentException(
                'Produksi harus lebih besar dari 0.'
            );
        }

        // Rumus FSA:
        // hi = (ei + d0) / t0
        $hargaMinimalHi = (
            $keuntunganEi + $biayaProduksiD0
        ) / $produksiT0;

        return $hargaMinimalHi;
    }
}
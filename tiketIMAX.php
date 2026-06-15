<?php

require_once __DIR__ . '/Tiket.php';

// ============================================================
//  Class : TiketIMAX
//  Mewarisi abstract class Tiket.
//  Properti tambahan : kacamata3dId, efekGerakFitur
// ============================================================
class TiketIMAX extends Tiket {

    // ── Properti Tambahan (Spesifik IMAX) ────────────────────
    // Pemetaan kolom: kacamata_3d_id, efek_gerak_fitur

    /** @var string|null Pemetaan kolom: kacamata_3d_id (nomor seri kacamata 3D) */
    private ?string $kacamata3dId;

    /** @var string|null Pemetaan kolom: efek_gerak_fitur (misal: 4DX motion seat) */
    private ?string $efekGerakFitur;

    // Surcharge tetap untuk IMAX
    private const SURCHARGE_IMAX = 25000;

    // ── Constructor ──────────────────────────────────────────
    public function __construct(
        int     $id_tiket,
        string  $nama_film,
        string  $jadwal_tayang,
        int     $jumlah_kursi,
        float   $hargaDasarTiket,
        ?string $kacamata3dId   = null,
        ?string $efekGerakFitur = null
    ) {
        parent::__construct(
            $id_tiket,
            $nama_film,
            $jadwal_tayang,
            $jumlah_kursi,
            $hargaDasarTiket
        );

        $this->kacamata3dId   = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    // ── Implementasi Abstract Method: hitungTotalHarga ───────
    // IMAX: harga dasar + surcharge IMAX, dikali jumlah kursi
    public function hitungTotalHarga(): float {
        return ($this->hargaDasarTiket + self::SURCHARGE_IMAX) * $this->jumlah_kursi;
    }

    // ── Implementasi Abstract Method: tampilkanInfoFasilitas ──
    public function tampilkanInfoFasilitas(): void {
        $kacamata    = $this->kacamata3dId   ?? '<em>Tidak tersedia</em>';
        $efekGerak   = $this->efekGerakFitur ?? '<em>Tidak tersedia</em>';

        echo "<div style='font-family:sans-serif; border:1px solid #0057b8;
                          padding:10px; margin:8px 0; border-radius:6px;'>
                <h3 style='margin:0 0 8px; color:#0057b8;'>
                    🎥 Studio IMAX — {$this->nama_film}
                </h3>
                <ul>
                    <li><strong>ID Kacamata 3D</strong> : {$kacamata}</li>
                    <li><strong>Efek Gerak Fitur</strong> : {$efekGerak}</li>
                    <li><strong>Surcharge IMAX</strong> : Rp "
                        . number_format(self::SURCHARGE_IMAX, 0, ',', '.') .
                    "</li>
                    <li><strong>Total Harga</strong> : Rp "
                        . number_format($this->hitungTotalHarga(), 0, ',', '.') .
                    "</li>
                </ul>
              </div>";
    }

    // ── Getters ──────────────────────────────────────────────
    public function getKacamata3dId(): ?string   { return $this->kacamata3dId; }
    public function getEfekGerakFitur(): ?string { return $this->efekGerakFitur; }
}
<?php

require_once __DIR__ . '/Tiket.php';

// ============================================================
//  Class : TiketVelvet
//  Mewarisi abstract class Tiket.
//  Properti tambahan : bantalSelimutPack, layananButler
// ============================================================
class TiketVelvet extends Tiket {

    // ── Properti Tambahan (Spesifik Velvet) ──────────────────
    // Pemetaan kolom: bantal_selimut_pack, layanan_butler

    /** @var bool Pemetaan kolom: bantal_selimut_pack (1 = tersedia) */
    private bool $bantalSelimutPack;

    /** @var string|null Pemetaan kolom: layanan_butler (deskripsi layanan) */
    private ?string $layananButler;

    // Surcharge tetap untuk Velvet
    private const SURCHARGE_VELVET = 75000;

    // ── Constructor ──────────────────────────────────────────
    public function __construct(
        int     $id_tiket,
        string  $nama_film,
        string  $jadwal_tayang,
        int     $jumlah_kursi,
        float   $hargaDasarTiket,
        bool    $bantalSelimutPack = true,
        ?string $layananButler     = null
    ) {
        parent::__construct(
            $id_tiket,
            $nama_film,
            $jadwal_tayang,
            $jumlah_kursi,
            $hargaDasarTiket
        );

        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler     = $layananButler;
    }

    // ── Implementasi Abstract Method: hitungTotalHarga ───────
    // Velvet: harga dasar + surcharge Velvet, dikali jumlah kursi
    public function hitungTotalHarga(): float {
        return ($this->hargaDasarTiket + self::SURCHARGE_VELVET) * $this->jumlah_kursi;
    }

    // ── Implementasi Abstract Method: tampilkanInfoFasilitas ──
    public function tampilkanInfoFasilitas(): void {
        $bantal  = $this->bantalSelimutPack ? '✅ Tersedia' : '❌ Tidak tersedia';
        $butler  = $this->layananButler     ?? '<em>Tidak ada layanan butler</em>';

        echo "<div style='font-family:sans-serif; border:1px solid #7b2d8b;
                          padding:10px; margin:8px 0; border-radius:6px;'>
                <h3 style='margin:0 0 8px; color:#7b2d8b;'>
                    👑 Studio Velvet — {$this->nama_film}
                </h3>
                <ul>
                    <li><strong>Bantal &amp; Selimut Pack</strong> : {$bantal}</li>
                    <li><strong>Layanan Butler</strong> : {$butler}</li>
                    <li><strong>Surcharge Velvet</strong> : Rp "
                        . number_format(self::SURCHARGE_VELVET, 0, ',', '.') .
                    "</li>
                    <li><strong>Total Harga</strong> : Rp "
                        . number_format($this->hitungTotalHarga(), 0, ',', '.') .
                    "</li>
                </ul>
              </div>";
    }

    // ── Getters ──────────────────────────────────────────────
    public function getBantalSelimutPack(): bool  { return $this->bantalSelimutPack; }
    public function getLayananButler(): ?string   { return $this->layananButler; }
}
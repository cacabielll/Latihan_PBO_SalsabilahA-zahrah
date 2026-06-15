<?php

require_once __DIR__ . '/Tiket.php';

// ============================================================
//  Class : TiketRegular
//  Mewarisi abstract class Tiket.
//  Properti tambahan : tipeAudio, lokasiBaris
// ============================================================
class TiketRegular extends Tiket {

    // ── Properti Tambahan (Spesifik Regular) ─────────────────
    // Pemetaan kolom: tipe_audio, lokasi_baris

    /** @var string Pemetaan kolom: tipe_audio (misal: Stereo, DTS) */
    private string $tipeAudio;

    /** @var string Pemetaan kolom: lokasi_baris (misal: A, B, C) */
    private string $lokasiBaris;

    // ── Constructor ──────────────────────────────────────────
    public function __construct(
        int    $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int    $jumlah_kursi,
        float  $hargaDasarTiket,
        string $tipeAudio,
        string $lokasiBaris
    ) {
        // Panggil constructor induk untuk mengisi properti global
        parent::__construct(
            $id_tiket,
            $nama_film,
            $jadwal_tayang,
            $jumlah_kursi,
            $hargaDasarTiket
        );

        $this->tipeAudio   = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    // ── Implementasi Abstract Method: hitungTotalHarga ───────
    // Regular: tidak ada surcharge — total = harga dasar * jumlah kursi
    public function hitungTotalHarga(): float {
        return $this->hargaDasarTiket * $this->jumlah_kursi;
    }

    // ── Implementasi Abstract Method: tampilkanInfoFasilitas ──
    public function tampilkanInfoFasilitas(): void {
        echo "<div style='font-family:sans-serif; border:1px solid #ccc;
                          padding:10px; margin:8px 0; border-radius:6px;'>
                <h3 style='margin:0 0 8px; color:#333;'>
                    🎬 Studio Regular — {$this->nama_film}
                </h3>
                <ul>
                    <li><strong>Tipe Audio</strong> : {$this->tipeAudio}</li>
                    <li><strong>Lokasi Baris</strong> : {$this->lokasiBaris}</li>
                    <li><strong>Total Harga</strong> : Rp "
                        . number_format($this->hitungTotalHarga(), 0, ',', '.') .
                    "</li>
                </ul>
              </div>";
    }

    // ── Getters ──────────────────────────────────────────────
    public function getTipeAudio(): string   { return $this->tipeAudio; }
    public function getLokasiBaris(): string { return $this->lokasiBaris; }
}
<?php

// Pastikan class Database tersedia
require_once __DIR__ . '/koneksi/database.php';

// ============================================================
//  Abstract Class : Tiket
//  Merepresentasikan entitas tiket bioskop secara umum.
//  Kelas ini TIDAK bisa diinstansiasi langsung — harus
//  diturunkan ke kelas anak (Regular, IMAX, Velvet, dst.)
// ============================================================
abstract class Tiket {

    // ── Protected Properties (Enkapsulasi) ───────────────────
    // Nilai properti ini wajib dipetakan dari kolom tabel_tiket
    // yang telah dibuat pada Tahap 1.

    /** @var int Pemetaan kolom: id_tiket (PRIMARY KEY) */
    protected int $id_tiket;

    /** @var string Pemetaan kolom: nama_film */
    protected string $nama_film;

    /** @var string Pemetaan kolom: jadwal_tayang (DATETIME → string) */
    protected string $jadwal_tayang;

    /** @var int Pemetaan kolom: jumlah_kursi */
    protected int $jumlah_kursi;

    /** @var float Pemetaan kolom: harga_dasar_tiket (DECIMAL) */
    protected float $hargaDasarTiket;

    // ── Constructor ──────────────────────────────────────────
    public function __construct(
        int    $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int    $jumlah_kursi,
        float  $hargaDasarTiket
    ) {
        $this->id_tiket        = $id_tiket;
        $this->nama_film       = $nama_film;
        $this->jadwal_tayang   = $jadwal_tayang;
        $this->jumlah_kursi    = $jumlah_kursi;
        $this->hargaDasarTiket = $hargaDasarTiket;
    }

    // ── Abstract Methods (Tanpa Body) ────────────────────────
    // Setiap kelas anak WAJIB mengimplementasikan kedua metode ini.

    /**
     * Menghitung total harga tiket.
     * Implementasi berbeda di tiap jenis studio
     * (misal: Regular = harga dasar, IMAX = harga dasar + surcharge, dst.)
     */
    abstract public function hitungTotalHarga(): float;

    /**
     * Menampilkan informasi fasilitas yang tersedia
     * sesuai jenis studio masing-masing.
     */
    abstract public function tampilkanInfoFasilitas(): void;

    // ── Concrete Methods (Opsional — bisa dipakai semua anak) ─
    /**
     * Menampilkan informasi umum tiket (dari atribut global/induk).
     */
    public function tampilkanInfoUmum(): void {
        echo "<table border='1' cellpadding='6' style='font-family:sans-serif; border-collapse:collapse;'>
                <tr><th>ID Tiket</th><td>{$this->id_tiket}</td></tr>
                <tr><th>Film</th><td>{$this->nama_film}</td></tr>
                <tr><th>Jadwal Tayang</th><td>{$this->jadwal_tayang}</td></tr>
                <tr><th>Jumlah Kursi</th><td>{$this->jumlah_kursi}</td></tr>
                <tr><th>Harga Dasar</th><td>Rp " . number_format($this->hargaDasarTiket, 0, ',', '.') . "</td></tr>
              </table><br>";
    }

    // ── Getters ──────────────────────────────────────────────
    public function getIdTiket(): int      { return $this->id_tiket; }
    public function getNamaFilm(): string  { return $this->nama_film; }
    public function getJadwalTayang(): string { return $this->jadwal_tayang; }
    public function getJumlahKursi(): int  { return $this->jumlah_kursi; }
    public function getHargaDasarTiket(): float { return $this->hargaDasarTiket; }
}
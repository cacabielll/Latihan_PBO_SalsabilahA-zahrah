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
     * Menampilkan informasi fasilitas tiket.
     * Setiap jenis tiket memiliki fasilitas berbeda
     * (misal: Regular = audio, IMAX = 3D glasses, Velvet = butler service, dst.)
     */
    abstract public function tampilkanInfoFasilitas(): void;

    // ── Getters ──────────────────────────────────────────────
    public function getIdTiket(): int      { return $this->id_tiket; }
    public function getNamaFilm(): string  { return $this->nama_film; }
    public function getJadwalTayang(): string { return $this->jadwal_tayang; }
    public function getJumlahKursi(): int  { return $this->jumlah_kursi; }
    public function getHargaDasarTiket(): float { return $this->hargaDasarTiket; }

    // ── Static Method: selectAllTiket ─────────────────────────
    /**
     * Mengambil semua data dari tabel tiket
     * @return array Array yang berisi hasil query dari tabel tiket
     */
    public static function selectAllTiket(): array {
        $db = new Database();
        $result = $db->query("SELECT * FROM tiket");
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }

    // ── Static Method: selectWhereTiket ────────────────────────
    /**
     * Mengambil data dari tabel tiket dengan kondisi WHERE
     * @param string $whereClause Kondisi WHERE (contoh: "id_tiket = 1" atau "nama_film = 'Avatar'")
     * @return array Array yang berisi hasil query dari tabel tiket sesuai kondisi
     */
    public static function selectWhereTiket(string $whereClause): array {
        $db = new Database();
        $result = $db->query("SELECT * FROM tiket WHERE " . $whereClause);
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }
}
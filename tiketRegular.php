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

    // ── Implementasi Abstract Method: tampilkanInfoFasilitas ─
    public function tampilkanInfoFasilitas(): void {
        echo "=== Fasilitas Tiket Regular ===\n";
        echo "Tipe Audio: " . $this->tipeAudio . "\n";
        echo "Lokasi Baris: " . $this->lokasiBaris . "\n";
        echo "Surcharge: Tidak ada\n";
    }

    // ── Getters ──────────────────────────────────────────────
    public function getTipeAudio(): string   { return $this->tipeAudio; }
    public function getLokasiBaris(): string { return $this->lokasiBaris; }

    // ── Static Method: selectAllRegular ────────────────────────
    /**
     * Mengambil semua data dari tabel tiket_regular
     * @return array Array yang berisi hasil query dari tabel tiket_regular
     */
    public static function selectAllRegular(): array {
        $db = new Database();
        $result = $db->query("SELECT * FROM tiket_regular");
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }

    // ── Static Method: selectWhereRegular ────────────────────────
    /**
     * Mengambil data dari tabel tiket_regular dengan kondisi WHERE
     * @param string $whereClause Kondisi WHERE (contoh: "id_tiket = 1" atau "lokasi_baris = 'A'")
     * @return array Array yang berisi hasil query dari tabel tiket_regular sesuai kondisi
     */
    public static function selectWhereRegular(string $whereClause): array {
        $db = new Database();
        $result = $db->query("SELECT * FROM tiket_regular WHERE " . $whereClause);
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }
}
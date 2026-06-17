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
    // Velvet: surcharge/biaya tambahan kelas premium sebesar 50% dari total harga dasar
    // total = (jumlah kursi * harga dasar tiket) * 1.50
    public function hitungTotalHarga(): float {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }

    // ── Implementasi Abstract Method: tampilkanInfoFasilitas ─
    public function tampilkanInfoFasilitas(): void {
        echo "=== Fasilitas Tiket Velvet ===\n";
        echo "Bantal & Selimut Pack: " . ($this->bantalSelimutPack ? "Tersedia" : "Tidak Tersedia") . "\n";
        echo "Layanan Butler: " . ($this->layananButler ?? "N/A") . "\n";
        echo "Surcharge Kelas Premium Velvet: 50% dari total harga dasar (Rp " . number_format($this->jumlah_kursi * $this->hargaDasarTiket * 0.50, 0, ',', '.') . ")\n";
    }

    // ── Getters ──────────────────────────────────────────────
    public function getBantalSelimutPack(): bool  { return $this->bantalSelimutPack; }
    public function getLayananButler(): ?string   { return $this->layananButler; }

    // ── Static Method: selectAll ─────────────────────────────
    /**
     * Mengambil semua data dari tabel tiket_velvet
     * @return array Array yang berisi hasil query dari tabel tiket_velvet
     */
    public static function selectAllVelvet(): array {
        $db = new Database();
        $result = $db->query("SELECT * FROM tiket_velvet");
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }

    // ── Static Method: selectWhereVelvet ────────────────────────
    /**
     * Mengambil data dari tabel tiket_velvet dengan kondisi WHERE
     * @param string $whereClause Kondisi WHERE (contoh: "id_tiket = 1" atau "bantal_selimut_pack = 1")
     * @return array Array yang berisi hasil query dari tabel tiket_velvet sesuai kondisi
     */
    public static function selectWhereVelvet(string $whereClause): array {
        $db = new Database();
        $result = $db->query("SELECT * FROM tiket_velvet WHERE " . $whereClause);
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }
}
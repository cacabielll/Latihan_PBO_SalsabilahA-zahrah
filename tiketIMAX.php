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

    // ── Implementasi Abstract Method: tampilkanInfoFasilitas ─
    public function tampilkanInfoFasilitas(): void {
        echo "=== Fasilitas Tiket IMAX ===\n";
        echo "Kacamata 3D ID: " . ($this->kacamata3dId ?? "N/A") . "\n";
        echo "Efek Gerak Fitur: " . ($this->efekGerakFitur ?? "N/A") . "\n";
        echo "Surcharge IMAX: Rp " . number_format(self::SURCHARGE_IMAX, 0, ',', '.') . "\n";
    }

    // ── Getters ──────────────────────────────────────────────
    public function getKacamata3dId(): ?string   { return $this->kacamata3dId; }
    public function getEfekGerakFitur(): ?string { return $this->efekGerakFitur; }

    // ── Static Method: selectAll ─────────────────────────────
    /**
     * Mengambil semua data dari tabel tiket_imax
     * @return array Array yang berisi hasil query dari tabel tiket_imax
     */
    public static function selectAll(): array {
        $db = new Database();
        $result = $db->query("SELECT * FROM tiket_imax");
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }

    // ── Static Method: selectWhere ────────────────────────────
    /**
     * Mengambil data dari tabel tiket_imax dengan kondisi WHERE
     * @param string $whereClause Kondisi WHERE (contoh: "id_tiket = 1" atau "efek_gerak_fitur = '4DX'")
     * @return array Array yang berisi hasil query dari tabel tiket_imax sesuai kondisi
     */
    public static function selectWhere(string $whereClause): array {
        $db = new Database();
        $result = $db->query("SELECT * FROM tiket_imax WHERE " . $whereClause);
        
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }
}
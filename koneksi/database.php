<?php

class Database {

    // ── Properties ───────────────────────────────────────────
    private string $host;
    private string $user;
    private string $pass;
    private string $dbName;
    private mysqli  $conn;

    // ── Constructor ──────────────────────────────────────────
    public function __construct(
        string $host   = 'localhost',
        string $user   = 'root',
        string $pass   = '',
        string $dbName = 'db_latihan_pbo_ti1c_salsabilaha_zahrah'
    ) {
        $this->host   = $host;
        $this->user   = $user;
        $this->pass   = $pass;
        $this->dbName = $dbName;

        $this->connect();
    }

    // ── Method: connect ──────────────────────────────────────
    private function connect(): void {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbName
        );

        // Tangani error koneksi
        if ($this->conn->connect_error) {
            die(
                "[GAGAL] Koneksi ke database gagal.\n" .
                "Error  : " . $this->conn->connect_error . "\n"
            );
        }

        // Set charset agar karakter UTF-8 / bahasa Indonesia aman
        $this->conn->set_charset('utf8mb4');

        echo "[SUKSES] Terhubung ke database '{$this->dbName}' pada host '{$this->host}'.\n";
    }

    // ── Method: getConnection ────────────────────────────────
    public function getConnection(): mysqli {
        return $this->conn;
    }

    // ── Method: closeConnection ──────────────────────────────
    public function closeConnection(): void {
        if (isset($this->conn) && !$this->conn->connect_error) {
            $this->conn->close();
            echo "[INFO] Koneksi ke database '{$this->dbName}' telah ditutup.\n";
        }
    }

    // ── Destructor ───────────────────────────────────────────
    public function __destruct() {
        $this->closeConnection();
    }
}


// ════════════════════════════════════════════════════════════
//  Penggunaan / Instansiasi
// ════════════════════════════════════════════════════════════
$db = new Database();

// Ambil objek koneksi mysqli jika dibutuhkan di file lain
$conn = $db->getConnection();
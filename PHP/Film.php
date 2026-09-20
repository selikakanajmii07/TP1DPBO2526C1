<?php
class Film {
    private int $id;
    private string $judul;
    private string $genre;
    private string $jamTayang;
    private string $gambar;

    // Constructor
    public function __construct(int $id, string $judul, string $genre, string $jamTayang, string $gambar) {
        $this->id = $id;
        $this->judul = $judul;
        $this->genre = $genre;
        $this->jamTayang = $jamTayang;
        $this->gambar = $gambar;
    }

    // Getter
    public function getId(): int { return $this->id; }
    public function getJudul(): string { return $this->judul; }
    public function getGenre(): string { return $this->genre; }
    public function getJamTayang(): string { return $this->jamTayang; }
    public function getGambar(): string { return $this->gambar; }

    // Setter
    public function setJudul(string $judul): void { $this->judul = $judul; }
    public function setGenre(string $genre): void { $this->genre = $genre; }
    public function setJamTayang(string $jamTayang): void { $this->jamTayang = $jamTayang; }
    public function setGambar(string $gambar): void { $this->gambar = $gambar; }
}

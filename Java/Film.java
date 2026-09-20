public class Film {
    private int id;
    private String judul;
    private String genre;
    private String jamTayang;
    private String gambar;

    // Constructor kosong
    public Film() {}

    // Constructor berparameter
    public Film(int id, String judul, String genre, String jamTayang, String gambar) {
        this.id = id;
        this.judul = judul;
        this.genre = genre;
        this.jamTayang = jamTayang;
        this.gambar = gambar;
    }

    // Getter
    public int getId() { return id; }
    public String getJudul() { return judul; }
    public String getGenre() { return genre; }
    public String getJamTayang() { return jamTayang; }
    public String getGambar() { return gambar; }

    // Setter
    public void setJudul(String judul) { this.judul = judul; }
    public void setGenre(String genre) { this.genre = genre; }
    public void setJamTayang(String jamTayang) { this.jamTayang = jamTayang; }
    public void setGambar(String gambar) { this.gambar = gambar; }

    public void tampilkan() {
        System.out.println("ID           : " + id);
        System.out.println("Judul        : " + judul);
        System.out.println("Genre        : " + genre);
        System.out.println("Jam Tayang   : " + jamTayang);
        System.out.println("Gambar       : " + gambar);
        System.out.println("-----------------------------");
    }
}

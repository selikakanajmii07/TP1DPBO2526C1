import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    static ArrayList<Film> daftarFilm = new ArrayList<>();
    static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        int pilihan;

        do {
            tampilkanMenu();
            pilihan = Integer.parseInt(scanner.nextLine().trim());

            switch (pilihan) {
                case 1: tambahData(); break;
                case 2: tampilkanData(); break;
                case 3: cariData(); break;
                case 4: updateData(); break;
                case 5: hapusData(); break;
                case 0: System.out.println("\nKeluar dari program. Sampai jumpa!"); break;
                default: System.out.println("\nPilihan tidak valid!\n"); break;
            }
        } while (pilihan != 0);
    }

    static void tampilkanMenu() {
        System.out.println("===== MENU BIOSKOP =====");
        System.out.println("1. Tambah Data Film");
        System.out.println("2. Tampilkan Semua Data Film");
        System.out.println("3. Cari Data Film");
        System.out.println("4. Update Data Film");
        System.out.println("5. Hapus Data Film");
        System.out.println("0. Keluar");
        System.out.print("Pilih menu: ");
    }

    static void tambahData() {
        System.out.print("Masukkan ID Film     : ");
        int id = Integer.parseInt(scanner.nextLine().trim());
        System.out.print("Masukkan Judul Film  : ");
        String judul = scanner.nextLine();
        System.out.print("Masukkan Genre       : ");
        String genre = scanner.nextLine();
        System.out.print("Masukkan Jam Tayang  : ");
        String jamTayang = scanner.nextLine();
        System.out.print("Masukkan Path Gambar : ");
        String gambar = scanner.nextLine();

        Film filmBaru = new Film(id, judul, genre, jamTayang, gambar);
        daftarFilm.add(filmBaru);

        System.out.println("\nData film berhasil ditambahkan!\n");
    }

    static void tampilkanData() {
        if (daftarFilm.isEmpty()) {
            System.out.println("\nBelum ada data film.\n");
            return;
        }
        System.out.println("\n===== DAFTAR FILM =====");
        for (Film f : daftarFilm) {
            f.tampilkan();
        }
        System.out.println();
    }

    static int cariIndexById(int id) {
        for (int i = 0; i < daftarFilm.size(); i++) {
            if (daftarFilm.get(i).getId() == id) {
                return i;
            }
        }
        return -1;
    }

    static void cariData() {
        System.out.print("Masukkan ID Film yang dicari: ");
        int id = Integer.parseInt(scanner.nextLine().trim());

        int index = cariIndexById(id);
        if (index == -1) {
            System.out.println("\nData dengan ID " + id + " tidak ditemukan.\n");
        } else {
            System.out.println("\n===== DATA DITEMUKAN =====");
            daftarFilm.get(index).tampilkan();
            System.out.println();
        }
    }

    static void updateData() {
        System.out.print("Masukkan ID Film yang ingin diupdate: ");
        int id = Integer.parseInt(scanner.nextLine().trim());

        int index = cariIndexById(id);
        if (index == -1) {
            System.out.println("\nData dengan ID " + id + " tidak ditemukan.\n");
            return;
        }

        System.out.print("Masukkan Judul Baru        : ");
        String judul = scanner.nextLine();
        System.out.print("Masukkan Genre Baru        : ");
        String genre = scanner.nextLine();
        System.out.print("Masukkan Jam Tayang Baru   : ");
        String jamTayang = scanner.nextLine();
        System.out.print("Masukkan Path Gambar Baru  : ");
        String gambar = scanner.nextLine();

        Film f = daftarFilm.get(index);
        f.setJudul(judul);
        f.setGenre(genre);
        f.setJamTayang(jamTayang);
        f.setGambar(gambar);

        System.out.println("\nData berhasil diupdate!\n");
    }

    static void hapusData() {
        System.out.print("Masukkan ID Film yang ingin dihapus: ");
        int id = Integer.parseInt(scanner.nextLine().trim());

        int index = cariIndexById(id);
        if (index == -1) {
            System.out.println("\nData dengan ID " + id + " tidak ditemukan.\n");
            return;
        }

        daftarFilm.remove(index);
        System.out.println("\nData berhasil dihapus!\n");
    }
}

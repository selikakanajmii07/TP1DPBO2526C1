#include <iostream>
#include <vector>
#include "Film.h"
using namespace std;

vector<Film> daftarFilm;

void tambahData() {
    int id;
    string judul, genre, jamTayang, gambar;

    cout << "Masukkan ID Film     : ";
    cin >> id;
    cin.ignore();
    cout << "Masukkan Judul Film  : ";
    getline(cin, judul);
    cout << "Masukkan Genre       : ";
    getline(cin, genre);
    cout << "Masukkan Jam Tayang  : ";
    getline(cin, jamTayang);
    cout << "Masukkan Path Gambar : ";
    getline(cin, gambar);

    Film filmBaru(id, judul, genre, jamTayang, gambar);
    daftarFilm.push_back(filmBaru);

    cout << "\nData film berhasil ditambahkan!\n\n";
}

void tampilkanData() {
    if (daftarFilm.empty()) {
        cout << "\nBelum ada data film.\n\n";
        return;
    }
    cout << "\n===== DAFTAR FILM =====\n";
    for (size_t i = 0; i < daftarFilm.size(); i++) {
        daftarFilm[i].tampilkan();
    }
    cout << endl;
}

int cariIndexById(int id) {
    for (size_t i = 0; i < daftarFilm.size(); i++) {
        if (daftarFilm[i].getId() == id) {
            return (int)i;
        }
    }
    return -1;
}

void cariData() {
    int id;
    cout << "Masukkan ID Film yang dicari: ";
    cin >> id;

    int index = cariIndexById(id);
    if (index == -1) {
        cout << "\nData dengan ID " << id << " tidak ditemukan.\n\n";
    } else {
        cout << "\n===== DATA DITEMUKAN =====\n";
        daftarFilm[index].tampilkan();
        cout << endl;
    }
}

void updateData() {
    int id;
    cout << "Masukkan ID Film yang ingin diupdate: ";
    cin >> id;
    cin.ignore();

    int index = cariIndexById(id);
    if (index == -1) {
        cout << "\nData dengan ID " << id << " tidak ditemukan.\n\n";
        return;
    }

    string judul, genre, jamTayang, gambar;
    cout << "Masukkan Judul Baru        : ";
    getline(cin, judul);
    cout << "Masukkan Genre Baru        : ";
    getline(cin, genre);
    cout << "Masukkan Jam Tayang Baru   : ";
    getline(cin, jamTayang);
    cout << "Masukkan Path Gambar Baru  : ";
    getline(cin, gambar);

    daftarFilm[index].setJudul(judul);
    daftarFilm[index].setGenre(genre);
    daftarFilm[index].setJamTayang(jamTayang);
    daftarFilm[index].setGambar(gambar);

    cout << "\nData berhasil diupdate!\n\n";
}

void hapusData() {
    int id;
    cout << "Masukkan ID Film yang ingin dihapus: ";
    cin >> id;

    int index = cariIndexById(id);
    if (index == -1) {
        cout << "\nData dengan ID " << id << " tidak ditemukan.\n\n";
        return;
    }

    daftarFilm.erase(daftarFilm.begin() + index);
    cout << "\nData berhasil dihapus!\n\n";
}

void tampilkanMenu() {
    cout << "===== MENU BIOSKOP =====\n";
    cout << "1. Tambah Data Film\n";
    cout << "2. Tampilkan Semua Data Film\n";
    cout << "3. Cari Data Film\n";
    cout << "4. Update Data Film\n";
    cout << "5. Hapus Data Film\n";
    cout << "0. Keluar\n";
    cout << "Pilih menu: ";
}

int main() {
    int pilihan;

    do {
        tampilkanMenu();
        cin >> pilihan;

        switch (pilihan) {
            case 1: tambahData(); break;
            case 2: tampilkanData(); break;
            case 3: cariData(); break;
            case 4: updateData(); break;
            case 5: hapusData(); break;
            case 0: cout << "\nKeluar dari program. Sampai jumpa!\n"; break;
            default: cout << "\nPilihan tidak valid!\n\n"; break;
        }
    } while (pilihan != 0);

    return 0;
}

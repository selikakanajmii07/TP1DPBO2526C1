from film import Film

daftar_film = []


def tampilkan_menu():
    print("===== MENU BIOSKOP =====")
    print("1. Tambah Data Film")
    print("2. Tampilkan Semua Data Film")
    print("3. Cari Data Film")
    print("4. Update Data Film")
    print("5. Hapus Data Film")
    print("0. Keluar")


def cari_index_by_id(id_film):
    for i, film in enumerate(daftar_film):
        if film.getId() == id_film:
            return i
    return -1


def tambah_data():
    id_film = int(input("Masukkan ID Film     : "))
    judul = input("Masukkan Judul Film  : ")
    genre = input("Masukkan Genre       : ")
    jam_tayang = input("Masukkan Jam Tayang  : ")
    gambar = input("Masukkan Path Gambar : ")

    film_baru = Film(id_film, judul, genre, jam_tayang, gambar)
    daftar_film.append(film_baru)

    print("\nData film berhasil ditambahkan!\n")


def tampilkan_data():
    if not daftar_film:
        print("\nBelum ada data film.\n")
        return
    print("\n===== DAFTAR FILM =====")
    for film in daftar_film:
        film.tampilkan()
    print()


def cari_data():
    id_film = int(input("Masukkan ID Film yang dicari: "))
    index = cari_index_by_id(id_film)
    if index == -1:
        print(f"\nData dengan ID {id_film} tidak ditemukan.\n")
    else:
        print("\n===== DATA DITEMUKAN =====")
        daftar_film[index].tampilkan()
        print()


def update_data():
    id_film = int(input("Masukkan ID Film yang ingin diupdate: "))
    index = cari_index_by_id(id_film)
    if index == -1:
        print(f"\nData dengan ID {id_film} tidak ditemukan.\n")
        return

    judul = input("Masukkan Judul Baru        : ")
    genre = input("Masukkan Genre Baru        : ")
    jam_tayang = input("Masukkan Jam Tayang Baru   : ")
    gambar = input("Masukkan Path Gambar Baru  : ")

    film = daftar_film[index]
    film.setJudul(judul)
    film.setGenre(genre)
    film.setJamTayang(jam_tayang)
    film.setGambar(gambar)

    print("\nData berhasil diupdate!\n")


def hapus_data():
    id_film = int(input("Masukkan ID Film yang ingin dihapus: "))
    index = cari_index_by_id(id_film)
    if index == -1:
        print(f"\nData dengan ID {id_film} tidak ditemukan.\n")
        return

    daftar_film.pop(index)
    print("\nData berhasil dihapus!\n")


def main():
    pilihan = -1
    while pilihan != 0:
        tampilkan_menu()
        pilihan = int(input("Pilih menu: "))

        if pilihan == 1:
            tambah_data()
        elif pilihan == 2:
            tampilkan_data()
        elif pilihan == 3:
            cari_data()
        elif pilihan == 4:
            update_data()
        elif pilihan == 5:
            hapus_data()
        elif pilihan == 0:
            print("\nKeluar dari program. Sampai jumpa!")
        else:
            print("\nPilihan tidak valid!\n")


if __name__ == "__main__":
    main()

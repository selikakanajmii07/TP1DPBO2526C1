#ifndef FILM_H
#define FILM_H

#include <string>
using namespace std;

class Film {
private:
    int id;
    string judul;
    string genre;
    string jamTayang;
    string gambar;

public:
    Film();

    Film(int id, string judul, string genre, string jamTayang, string gambar);

    // Getter
    int getId();
    string getJudul();
    string getGenre();
    string getJamTayang();
    string getGambar();

    // Setter
    void setJudul(string judul);
    void setGenre(string genre);
    void setJamTayang(string jamTayang);
    void setGambar(string gambar);
    void tampilkan();

    ~Film();
};

#endif

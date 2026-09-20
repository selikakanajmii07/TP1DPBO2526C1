#include "Film.h"
#include <iostream>
using namespace std;

Film::Film() {}

Film::Film(int id, string judul, string genre, string jamTayang, string gambar) {
    this->id = id;
    this->judul = judul;
    this->genre = genre;
    this->jamTayang = jamTayang;
    this->gambar = gambar;
}

int Film::getId() { return id; }
string Film::getJudul() { return judul; }
string Film::getGenre() { return genre; }
string Film::getJamTayang() { return jamTayang; }
string Film::getGambar() { return gambar; }

void Film::setJudul(string judul) { this->judul = judul; }
void Film::setGenre(string genre) { this->genre = genre; }
void Film::setJamTayang(string jamTayang) { this->jamTayang = jamTayang; }
void Film::setGambar(string gambar) { this->gambar = gambar; }

void Film::tampilkan() {
    cout << "ID           : " << id << endl;
    cout << "Judul        : " << judul << endl;
    cout << "Genre        : " << genre << endl;
    cout << "Jam Tayang   : " << jamTayang << endl;
    cout << "Gambar       : " << gambar << endl;
    cout << "-----------------------------" << endl;
}

Film::~Film() {}

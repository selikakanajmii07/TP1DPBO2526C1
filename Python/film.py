class Film:
    def __init__(self, id: int, judul: str, genre: str, jam_tayang: str, gambar: str):
        self.__id = id
        self.__judul = str(judul)
        self.__genre = str(genre)
        self.__jam_tayang = str(jam_tayang)
        self.__gambar = str(gambar)

    # Getter
    def getId(self) -> int:
        return self.__id

    def getJudul(self) -> str:
        return self.__judul

    def getGenre(self) -> str:
        return self.__genre

    def getJamTayang(self) -> str:
        return self.__jam_tayang

    def getGambar(self) -> str:
        return self.__gambar

    # Setter
    def setJudul(self, judul: str) -> None:
        self.__judul = str(judul)

    def setGenre(self, genre: str) -> None:
        self.__genre = str(genre)

    def setJamTayang(self, jam_tayang: str) -> None:
        self.__jam_tayang = str(jam_tayang)

    def setGambar(self, gambar: str) -> None:
        self.__gambar = str(gambar)

    def tampilkan(self) -> None:
        print(f"ID           : {self.__id}")
        print(f"Judul        : {self.__judul}")
        print(f"Genre        : {self.__genre}")
        print(f"Jam Tayang   : {self.__jam_tayang}")
        print(f"Gambar       : {self.__gambar}")
        print("-----------------------------")

# API
Disini akan dijelaskan ketentuan dan cara penggunaan API
### Daftar Isi
 - [Search Provinces](#search-provinces)
 - [Search Cities](#search-cities)

## Search Provinces<a name="search-provinces"/>
Digunakan untuk mencari provinsi.

**Method**  <br />
GET http://127.0.0.1:8000/api/search/provinces? <parameter\><br />

**Header**  <br />
Accept	: application/json <br />

**Parameter** 
|Field Name    |Description             
|----------------|---------------------|
|id			|id provinsi yang ingin dicari, NOT NULL      |

**Success JSON Response** <br />
![provinces](https://github.com/Gerrystev/DOT/blob/main/asset/provinces.png?raw=true)

## Search Cities<a name="search-cities"/>
Digunakan untuk mencari kota.

**Method**  <br />
GET http://127.0.0.1:8000/api/search/cities? <parameter\><br />

**Header**  <br />
Accept	: application/json <br />

**Parameter** 
|Field Name    |Description             
|----------------|---------------------|
|id			|id kota yang ingin dicari, NOT NULL      |

**Success JSON Response** <br />
![cities](https://github.com/Gerrystev/DOT/blob/main/asset/cities.png?raw=true)

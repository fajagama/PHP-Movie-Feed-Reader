# Projekt
Jedná se o jednoduchou aplikaci, založenou na čtení feedu ve formátu json a mrss.
# Požadavky
```json
"php": ">=7.1.0",
```
# Instalace
- vytvoření konfiguračního souboru ze souboru config.example.php
# Příklad spouštění pomocí PHP CLI server
Pro MRSS.
```
php server.php MRSS
```
Pro JSON. Zde jsou navíc dva volitelné parametry, první pro číslo stránky a druhý pro jazyk textu.
```
php server.php JSON
php server.php JSON 2
php server.php JSON 3 cs-CS
```

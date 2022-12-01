# SozlukPHP
Türkçe sözlük API'ı için hazırlanmış bir PHP kütüphanesi.

## 📦 Kurulum
```sh 
composer require emrebakkal/sozlukphp
```

## 👨‍💻 Kullanım
Kütüphaneyi dosyaya dahil etmek
```php
<?php

require __DIR__ . '/vendor/autoload.php';
$sozluk = new SozlukPHP\Sozluk();
```

Kelimenin var olup olmadığını kontrol etmek
```php
echo $sozluk->checkWord("programlama");
// Bool (True veya False) dondurur
```
Kelimenin anlamını çekmek
```php
echo $sozluk->word("programlama")->getMeaning();
// Ekrana, verilen kelimenin ilk anlamini (0 index'ini) yazdirir. Dilerseniz parametre olarak istediginiz anlamin index degerini girebilirsiniz. 
```
Kelimenin tüm anlamlarını çekmek (Array)
```php
print_r($sozluk->word("programlama")->getMeanings());
// Ekrana, verilen kelimenin butun anlamlarini array tipinden yazdiracaktir.
```
Kelimenin tüm anlamlarının index sayısını çekmek
```php 
echo $sozluk->word("programlama")->countMeanings();
```
Kelimenin Türkçe sözlükteki ilk örnek cümlesini çekmek
```php
echo $sozluk->word("programlama")->getExample();
// Ekrana, verilen kelimenin ilk ornegini (0 index'ini) yazdirir. Dilerseniz parametre olarak istediginiz ornegin index degerini girebilirsiniz. 
```
Kelimenin ilk atasözünü çekmek
```php 
echo $sozluk->word("zafer")->getProverb();
// Ekrana, verilen kelimenin ilk atasozunu (0 index'ini) yazdirir. Dilerseniz parametre olarak istediginiz atasozunun index degerini girebilirsiniz. 
```
Kelimenin bütün atasözlerini çekmek (Array)
```php 
print_r($sozluk->word("fatih")->getProverbs());
```
Kelimenin atasözlerinin index sayısını çekmek
```php
echo $sozluk->word("ocak")->countProverbs();
```

Kelimenin Türkçe Sözlük veritabanındaki numarasını çekmek
```php
echo $sozluk->word("programlama")->getWordNo();
```
Kelimeninin takısını çekmek (varsa)
```php
echo $sozluk->word("kadir")->getAffix();
```
Kelimenin çoğul olup olmadığını çekmek
```php
echo $sozluk->word("programlama)->isPlural();
```
Kelimenin birleşiklerini çekmek
```php
echo $sozluk->word("araba")->getCompound();
```
Kelimenin telaffuzunu çekmek
```php
echo $sozluk->word("ordu")->getPronunciation();
```

---
## [Telegram](https://t.me/bpercent)'dan benimle iletişime geçebilirsiniz.
- Görüşlerinizi ve isteklerinizi paylaşmayı unutmayın. Eksik gördüğünüz vs. kısımlar için pull request atmayı ve repoyu yıldızlamayı unutmayın!

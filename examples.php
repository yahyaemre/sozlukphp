<?php

require __DIR__ . '/vendor/autoload.php'; // Autoload dosyasini dahil ediyoruz.

$sozluk = new SozlukPHP\Sozluk(); // Kutuphaneyi çağırıyoruz.

// Kelimeler word() fonksiyonu ile çağırılır. Bunu iki farklı şekilde yapabilirsiniz.

// 1. Yöntem
$word = $sozluk->word("programlama");
echo $word->getMeaning(); // Kelimenin anlamını yazdırır.

// 2. Yöntem
echo $sozluk->word("programlama")->getMeaning(); // Kelimenin anlamını yazdırır.


// Bu dosya basit kullanım örnegidir. Daha fazla örnek için lütfen repodaki readme'yi okuyun.
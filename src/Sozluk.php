<?php

// Author: Emre BAKKAL
// Repo: https://github.com/emrebakkal/sozlukphp

namespace SozlukPHP;

class Sozluk {
    public $url;
    public $data;
    public $word;

    private function fgc() {
        $this->url = "https://sozluk.gov.tr/gts?ara=";
        $this->data = json_decode(file_get_contents($this->url . @$this->word), true);
    }

    public function __construct() {
        $this->fgc();
    }

    // Kelimenin Türkçe sözlükte var olup olmadığını kontrol eder ve sonuç olarak boolean döndürür.
    public function checkWord($word) {
        $this->word = $word;
        $this->data = json_decode(file_get_contents($this->url . $this->word), true);
        if (@$this->data['error']) {
            return false;
        } else {
            return true;
        }
    }

    public function word($word) {
        $this->word = strtolower($word);
        return $this;
    }

// Kelimenin Sözlükteki No'sunu döndürür.
    public function getWordNo() {
        $this->fgc();
        return $this->checkWord($this->word) ? $this->data[0]['kelime_no'] : "Kelime bulunamadı.";
    }

    // Kelimenin takısını döndürür.
    public function getAffix() {
        $this->fgc();
        $affix = @$this->data[0]['taki'];
        return $this->checkWord($this->word) ? $affix ? $affix : "Kelimenin takısı yok." : "Kelime bulunamadı.";
    }

    // Kelimenin çoğul olup olmadığını boolean olarak döndürür.
    public function isPlural() {
        $this->fgc();
        $plural = $this->data[0]['cogul_mu'];
        return $this->checkWord($this->word) ? $plural ? true : false : "Kelime bulunamadı.";
    }

    // Kelimenin birleşiklerini döndürür.
    public function getCompound() {
        $this->fgc();
        $compound = @$this->data[0]['birlesikler'];
        return $this->checkWord($this->word) ? $compound ? $compound : "Kelimenin birleşikleri yok." : "Kelime bulunamadı.";
    }

    // Kelimenin telaffuzunu döndürür.
    public function getPronunciation() {
        $this->fgc();
        $telaffuz = $this->data[0]['telaffuz'];
        return $this->checkWord($this->word) ? $telaffuz ? $telaffuz : "Kelimenin telaffuzu bulunamadı." : "Kelime bulunamadı.";
    }

    // Kelimenin Türkçe sözlükteki anlamını verilen index'e göre döndürür. Varsayılan index 0'dır.
    public function getMeaning($index = 0) {
        $this->fgc();
        if ($this->checkWord($this->word)) {
            $data = (object) $this->data[0];
            $meaning = @$data->anlamlarListe[$index]['anlam'];
            if ($meaning) {
                return $meaning;
            } else {
                return "Anlam bulunamadı.";
            }
        } else {
            return "Kelime bulunamadı.";
        }
    }

    // Kelimenin Türkçe sözlükteki bütün anlamlarını döndürür.

    public function getMeanings() {
        $this->fgc();
        if ($this->checkWord($this->word)) {
            $data = $this->data[0];
            for ($i = 1; $i < count($data['anlamlarListe']); $i++) {
                $meanings[] = @$data['anlamlarListe'][$i]['anlam'];
            }
            if ($meanings) {
                return array_unique($meanings);
            } else {
                return "Anlamlar bulunamadı.";
            }
        } else {
            return "Kelime bulunamadı.";
        }
    }
    
    // Kelimenin kaç adet anlamı olduğunu integer olarak döndürür.
    public function countMeanings() {
        $this->fgc();
        return count(@$this->data[0]['anlamlarListe']);
    }

    // Kelimenin Türkçe sözlükteki ilk örnek cümlesini döndürür. (Varsayılan index 0'dır. Sonradan deger değiştirilebilir.)
    public function getExample($index = 0) {
        $this->fgc();
        if ($this->checkWord($this->word)) {
            $data = (object) $this->data[0];
            $example = @$data->anlamlarListe[0]['orneklerListe'][$index]['ornek'];
            $this->exampleId = $index;
            if ($example) {
                return $example;
            } else {
                return "Örnek bulunamadı.";
            }
        } else {
            return "Kelime bulunamadı.";
        }
    }
    
    // Kelimenin Türkçe sözlükte bulunan ilk atasözünü döndürür. (Varsayılan index 0'dır. Sonradan deger değiştirilebilir.)
    public function getProverb($index = 0) {
        $this->fgc();
        if ($this->checkWord($this->word)) {
            $data = $this->data[0];
            $proverb = @$data['atasozu'];
            if ($proverb) {
                return $proverb[$index]['madde'];
            } else {
                return "Atasözü bulunamadı.";
            }
        } else {
            return "Kelime bulunamadı.";
        }
    }
    
    //  Kelimenin Türkçe sözlükte bulunan atasözlerini döndürür.
    public function getProverbs() {
        $this->fgc();
        if ($this->checkWord($this->word)) {
            $data = $this->data[0];
            $proverb = @$data['atasozu'];
            for ($i = 0; $i < count($proverb); $i++) {
                $proverbs[] = @$proverb[$i]['madde'];
            }
            if ($proverbs) {
                return array_unique($proverbs);
            } else {
                return "Atasözü bulunamadı.";
            }
        }
    }

    // Kelimenin kaç adet atasözü olduğunu integer olarak döndürür.
    public function countProverbs() {
        $this->fgc();
        for ($i = 0; $i < count(@$this->data[0]['atasozu']); $i++) {
            $proverbs[] = @$this->data[0]['atasozu'][$i]['madde'];
        }
        return $proverbs ? count($proverbs) : 0;
    } 
}
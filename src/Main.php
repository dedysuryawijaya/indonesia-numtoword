<?php

namespace Wydesu\IndonesiaNumtoword;

class numToWord
{
    private $satuan = [
        'Satu',
        'Dua',
        'Tiga',
        'Empat',
        'Lima',
        'Enam',
        'Tujuh',
        'Delapan',
        'Sembilan',
        'Sepuluh',
        'Sebelas',
        'Dua Belas',
        'Tiga Belas',
        'Empat Belas',
        'Lima Belas',
        'Enam Belas',
        'Tujuh Belas',
        'Delapan Belas',
        'Sembilan Belas',
    ];

    private $puluhan = [
        "Dua Puluh",
        'Tiga Puluh',
        'Empat Puluh',
        'Lima Puluh',
        'Enam Puluh',
        'Tujuh Puluh',
        'Delapan Puluh',
        'Sembilan Puluh',
        'Sembilan Puluh'
    ];

    private $ribuan = [
        "",
        "Ribu",
        "Juta",
        "Miliar"
    ];

    private $kata;
    private $segmen;
    private $kalimat;

    public function __construct()
    {
        $this->kata = "";
        $this->segmen = 0;
        $this->kalimat = "";
    }

    /**
     * get sentences of numbers (e.g: 1, 29, 1355, 89238)
     * Minimum number is (0)
     * Maximum number is (999999999999)
     *
     * @param int $num
     */
    public function getSentences(int $num):string
    {
        if ($num == 0) {
            return "Nol";
        }

        while($num>0) {
            $chunk = $num % 1000;
            if ($chunk != 0) {
                $bagian = "";
                if ($chunk >= 100) {
                    $bagian .= $this->satuan[(int)($chunk / 100)-1]. " Ratus ";
                    $chunk %= 100;
                }
    
                if ($chunk >= 20) {
                    $bagian .= $this->puluhan[(int)($chunk/10)-2]. " ";
                    $chunk %= 10;
                }
    
                if ($chunk > 0) {
                    $bagian .= $this->satuan[$chunk - 1]. " ";
                }
    
                $this->kata = trim($bagian)." ".$this->ribuan[$this->segmen]." ".$this->kata;        
            }
    
            $num = (int) ($num / 1000);
            $this->segmen++;
        }
    
        $this->kalimat = trim($this->kata);
        $this->kalimat = str_replace('Satu Ratus', 'Seratus', $this->kalimat);
        $this->kalimat = substr($this->kalimat,0, 9) == "Satu Ribu" ? str_replace('Satu Ribu', 'Seribu', $this->kalimat) : $this->kalimat;

        return $this->kalimat;
    }
}
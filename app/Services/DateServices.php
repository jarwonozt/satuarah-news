<?php

namespace App\Services;

use Carbon\Carbon;

class DateServices {

    public static function dateHuman($value){
        Carbon::createFromFormat('Y:m:d H:i:s', $value)->diffForHumans();
    }
    public static function splitDate($dateTime,$type='int') {
        if(empty($dateTime)){
            $dateTime = date('Y-m-d H:i:s');
        }
        $t  = explode(' ',$dateTime);
        $t1 = explode('-',$t[0]);
        $t2 = explode(':',$t[1]);
        if ($type == 'int') {
            $x['date']   = (int) $t1[2];
            $x['month']  = (int) $t1[1];
            $x['year']   = (int) $t1[0];
            $x['hour']   = (int) $t2[0];
            $x['minute'] = (int) $t2[1];
            $x['second'] = (int) $t2[2];
        } else { // string
            $x['date']   = $t1[2];
            $x['month']  = $t1[1];
            $x['year']   = $t1[0];
            $x['hour']   = $t2[0];
            $x['minute'] = $t2[1];
            $x['second'] = $t2[2];
        }
        return $x;
    }
    public static function splitDateN($date){
        if(empty($date)){
            $date = date('d/m/Y');
        }
        $ex = explode('/',$date);
        $x['date']   = $ex[0];
        $x['month']  = $ex[1];
        $x['year']   = $ex[2];

        return $x;
    }
    public static function splitDateY($date){
        if(empty($date)){
            $date = date('Y-m-d');
        }
        $ex = explode('-',$date);
        $x['date']   = $ex[2];
        $x['month']  = $ex[1];
        $x['year']   = $ex[0];

        return $x;
    }
    public static function onlyDateSH($date){
        $ex = self::splitDateY($date);
        $tgl = $ex['date'].'/'.$ex['month'].'/'.$ex['year'];

        return $tgl;
    }
    public static function onlyDateDB($date){
        $ex = self::splitDateN($date);
        $tgl = $ex['year'].'-'.$ex['month'].'-'.$ex['date'];

        return $tgl;
    }
    public static function dateTimeNowToSQL(){
        return date("Y-m-d H:i:s");
    }
    public static function nowDateTimeMyFormat(){
        return date('d/m/Y H:i:s');;
    }
    public static function editDateTimeMyFormat($dateTime){
        if(!empty($dateTime)){
            $dt = self::splitDate($dateTime,'string');
            return $dt['date'].'/'.$dt['month'].'/'.$dt['year'].' '.$dt['hour'].':'.$dt['minute'].':'.$dt['second'];
        }
    }
    public static function dateTime($dateTime,$lang='id',$hari=true,$hari_panjang=true,$bulan_panjang=true,$waktu=true){
        if($lang == 'id'){
            $nama_hari_panjang = config('app.nama_hari_panjang_id');
            $nama_hari_pendek = config('app.nama_hari_pendek_id');
            $nama_bulan_panjang = config('app.nama_bulan_panjang_id');
            $nama_bulan_pendek = config('app.nama_bulan_pendek_id');
        }
        $x = self::splitDate($dateTime);
        $tgl = $x['date'];
        $bln = $x['month'];
        $thn = $x['year'];
        $jm  = $x['hour'];
        $mn  = $x['minute'];
        $dt  = $x['second'];

        $nm_hari = '';
        if($hari == true){
            $cd_day = date('w', mktime($jm,$mn,$dt,$bln,$tgl,$thn));
            if($hari_panjang == true){
                $nm_hari = $nama_hari_panjang[$cd_day];
            }else{
                $nm_hari = $nama_hari_pendek[$cd_day];
            }
        }
        $nm_bln = '';
        if($bulan_panjang == true){
            $nm_bln = $nama_bulan_panjang[$bln-1];
        }else{
            $nm_bln = $nama_bulan_pendek[$bln-1];
        }

        $wkt = '';
        if($waktu == true){
            $wkt = $jm.':'.$mn.' WIB';
        }

        $wak = sprintf("%02d", $jm);

        $wik = sprintf("%02d", $mn);

        $wuk = sprintf('WIB');


        return $nm_hari.', '.$tgl.' '.$nm_bln.' '.$thn.' | '.$wak.':'.$wik.' '.$wuk;
    }

    public static function dateHome($dateTime,$hari=true,$hari_panjang=true,$bulan_panjang=true,$waktu=false, $lang='id'){
        if($lang == 'id'){
            $nama_hari_panjang = config('app.nama_hari_panjang_id');
            $nama_hari_pendek = config('app.nama_hari_pendek_id');
            $nama_bulan_panjang = config('app.nama_bulan_panjang_id');
            $nama_bulan_pendek = config('app.nama_bulan_pendek_id');
        }
        $x = self::splitDate($dateTime);
        $tgl = $x['date'];
        $bln = $x['month'];
        $thn = $x['year'];
        $jm  = $x['hour'];
        $mn  = $x['minute'];
        $dt  = $x['second'];

        $nm_hari = '';
        if($hari == true){
            $cd_day = date('w', mktime($jm,$mn,$dt,$bln,$tgl,$thn));
            if($hari_panjang == true){
                $nm_hari = $nama_hari_panjang[$cd_day];
            }else{
                $nm_hari = $nama_hari_pendek[$cd_day];
            }
        }
        $nm_bln = '';
        if($bulan_panjang == true){
            $nm_bln = $nama_bulan_panjang[$bln-1];
        }else{
            $nm_bln = $nama_bulan_pendek[$bln-1];
        }


        return $nm_hari.', '.$tgl.' '.$nm_bln.' '.$thn;
    }

    public static function statusWaktu($date,$now=''){
        if($now == ''){
            $now = date("Y-m-d H:i:s");
        }
        $pembanding1 = self::splitDate($date);
        $pembanding2 = self::splitDate($now);
        $jarakTahun = $pembanding1['year'] - $pembanding2['year'];
        if($jarakTahun >= 1){
            $dateZ = date("z", mktime(0, 0, 0, $pembanding1['month'], $pembanding1['date'], $pembanding1['year']));
            $hasilDateZ = (365 * $jarakTahun) + $dateZ;
        }else{
            $hasilDateZ = date("z", mktime(0, 0, 0, $pembanding1['month'], $pembanding1['date'], $pembanding1['year']));
        }

        $hourFirst = $hasilDateZ * 24;
        $dateHourFirst = ($hourFirst + $pembanding1['hour']) * 60;
        $dateMinuteFirst = ($dateHourFirst + $pembanding1['minute']) * 60;
        $dateSecondFirst = ($dateMinuteFirst + $pembanding1['second']) * 60;

        $dateNow = date("z", mktime(0, 0, 0, $pembanding2['month'], $pembanding2['date'], $pembanding2['year']));
        $nowHour = $dateNow * 24;
        $dateNowHour = ($nowHour + $pembanding2['hour']) * 60;
        $dateNowMinute = ($dateNowHour + $pembanding2['minute']) * 60;
        $dateNowSecond = ($dateNowMinute + $pembanding2['second']) * 60;

        if($pembanding1['year'] < $pembanding2['year']){
            $pos = true;
        }else{
            if($hasilDateZ > $dateNow){
                $pos = false;
            }else{
                if($dateSecondFirst > $dateNowSecond){
                    $pos = false;
                }else{
                    $pos = true;
                }
            }
        }

        return $pos;
    }
}

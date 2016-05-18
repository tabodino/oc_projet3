<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 17/05/16
 * Time: 14:54
 */

namespace OC\CoreBundle\Services;


class AgeCalculator
{
    // Méthode pour obtenir l'age d'un visiteur
    public function getAge($birthday)
    {
        list($year, $month, $day) = explode('-', $birthday);
        $today['month'] = date('n');
        $today['day'] = date('j');
        $today['year'] = date('Y');
        $years = $today['year'] - $year;
        if ($today['month'] <= $month) {
            if ($month == $today['month']) {
                if ($day > $today['day'])
                    $years--;
            }
            else
                $years--;
        }

        return $years;
    }

    public function getPriceByAge($age, $reduced=false)
    {
        $price = 0;

        if ($reduced  == true) {
            $price = 10;
        }
        
        return $price;
    }
}
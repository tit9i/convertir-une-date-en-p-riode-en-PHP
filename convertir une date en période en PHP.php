<?php
define('CONFIGDB_SERVER_COUNTRY', 'FR');
define('YEAR_DATE', 'an');
define('DAYS', 'jour');
define('TIME', 'heure');
define('MINUTE', 'minute');
define('SECOND', 'seconde');
define('INSTANTLY', 'à l\'instant');
define('PLURIEL_AFF', 's');
define('AGO_DATE', 'il y a ');

    function calctime($date_now, $date_start)
    {
        // $inst_routines = new core_Routines();
        $formatter = new IntlDateFormatter('fr_' . CONFIGDB_SERVER_COUNTRY . '', IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN);
        $dateFrom = new DateTime('' . $date_start . '');
        $dateNow = new DateTime('' . $date_now . '');
        $interval = $dateNow->diff($dateFrom);
        //return $interval->format('%y ans %m mois %d jours %h heures %i minutes %s secondes');
        $sec = $interval->format('%s');
        $min = $interval->format(' %i ');
        $heure = $interval->format('%h');
        $jour = $interval->format(' %d');
        $mois = $interval->format(' %m');
        $year = $interval->format(' %y');

        if ($year > 0) {
            return ' ' . $year . ' ' . YEAR_DATE . '' . AuPluriel($year) . ' ' . AGO_DATE . '';
        } elseif ($mois > 0) {
            return ' ' . $formatter->format($dateFrom) . ''; //  10 july 2015 to 8:22 p.m.

            //return 'il y a '.$mois.' mois';
        } elseif ($jour > 0) {
            if ($jour > 5) {
                // str_replace(':', SHUT_TIME_DATE, $dateFrom->format(''.FORMAT_TIME24_LG.':i '.FORMAT_TIMEAMPM_LG.''));
                return ' ' . $formatter->format($dateFrom) . ''; //  7 August 2015 at 2:27 p.m.  date("F j, Y, g:i a")

            } else {
                return '' . $jour . ' ' . DAYS . '' . AuPluriel($jour) . '';  // two days ago at 8:38
            }
        } elseif ($heure > 0) {
            return AGO_DATE . $heure . ' ' . TIME . '';
        } elseif ($min > 0) {
            return AGO_DATE . $min . '' . MINUTE . ''. AuPluriel($min) . '';
        } elseif ($min > 0) {
            return AGO_DATE . $sec . ' ' . SECOND . ''. AuPluriel($sec) . '';
        } else {
            return '' . INSTANTLY . '';
        }
    }

     function AuPluriel($chiffre)
    {
        if ($chiffre > 1) {
            return '' . PLURIEL_AFF . '';
        };
    }

    echo calctime('' . date("Y-m-d") . ' ' . date("H:i:s") . '', "2020-11-02 13:30:00");
 ?>
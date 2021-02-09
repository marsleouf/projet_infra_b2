<?php

namespace space\date;

class month {

    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    private $months = ['Janvier', 'Février', 'Mars', 'Avril' , 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year;


    // Constructeur de la classe, prends un mois entre 1 et 12 et une année
    public function __construct(?int $month = null, ?int $year = null)
    {
        if ($month === null || $month < 1 || $month > 12) {
            $month = intval(date('m'));
        }
        if ($year === null) {
            $year = intval(date('Y'));
        }
        
        $this->month = $month;
        $this->year = $year;        
    }

    // renvoie le premier jour du mois
    public function getStartingDay(): \DateTime {
        return $start = new \DateTime("{$this->year}-{$this->month}-01");
    }


    // retourne le mois en lettres
    public function toString (): string {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }


    // retourne le nombre de semaines dans le mois en cours
    public function getWeeks(): int {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $startweek = intval($start->format('W'));
        $endweek = intval($end->format('W'));
    
        if ($endweek === 1)
        {
            $endweek = intval((clone $end)->modify('-7 days')->format('W')) + 1;
        }
        $weeks = $endweek - $startweek + 1;
        if ($weeks < 0)
        {
            $weeks = intval($end->format('W'));
        }
        return $weeks;

    }

    // détermine si le jour est dans le mois en cours
    public function withinMonth (\DateTime $date): bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    // retourne le mois suivant
    public function nextMonth(): month 
    {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month > 12)
        {
            $month = 1;
            $year += 1;
        }
        return new month($month, $year);
    }

    // retourne le mois précédent
     public function previousMonth(): month 
    {
        $month = $this->month - 1;
        $year = $this->year;
        if ($month < 1)
        {
            $month = 12;
            $year -= 1;
        }
        return new month($month, $year);
    }
}
?>
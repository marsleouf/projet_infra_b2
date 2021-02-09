<?php

// Construction de l'object user

    class user
    {
        public $id_user;
        public $nom;
        public $prenom;
        public $mail;
        private $solde;
        public $path_img;
        private $mdp;

        public function __construct(array $donnees)
        {
            $this->hydrate($donnees);
        }

        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $value)
            {
                $method = 'set'.ucfirst($key);

                if (method_exists($this, $method))
                {
                    $this->$method($value);
                }
            }
        }

        public function getMdp()
        {
            return $this->mdp;
        }

        public function id_user(){
            return $this->id_user;
        }

        public function nom(){
            return $this->nom;
        }

        public function prenom(){
            return $this->prenom;
        }

        public function mail(){
            return $this->mail;
        }

        public function solde(){
            return $this->solde;
        }

        public function path_img(){
            return $this->path_img;
        }

        public function mdp(){
            return $this->mdp;
        }

        public function setId_user($id_user_envoyer){
            $id_user = (int) $id_user_envoyer;
            $this->id_user = $id_user;
        }
        
        public function setNom($nom_envoyer){
            if (is_string($nom_envoyer))
            {
                $this->nom = htmlspecialchars($nom_envoyer);
            }
        }

        public function setPrenom($prenom_envoyer){
            if (is_string($prenom_envoyer))
            {
                $this->prenom = htmlspecialchars($prenom_envoyer);
            }
        }

        public function setMail($mail_envoyer){
            if (is_string($mail_envoyer))
            {
                $this->mail = htmlspecialchars($mail_envoyer);
            }
        }

        public function setSolde($solde_envoyer){
            $solde = (float) $solde_envoyer;
            $this->solde = $solde;
        }

        public function setPath_img($path_envoyer){
            if (is_string($path_envoyer))
            {
                $this->path_img = htmlspecialchars($path_envoyer);
            }
        }

        public function setMdp($mdp_envoyer){
            if (is_string($mdp_envoyer))
            {
                $this->mdp = htmlspecialchars($mdp_envoyer);
            }
        }
    }
?>
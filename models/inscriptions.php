<?php
class inscriptions extends Base{
    function inscription() {
        $this->open();
        $this->msg = "<font color='red'>Une erreur vient de ce produire.</br>Veuillez le signaler aux administrateurs.</font>";
        try{
            if (is_array($_POST)){
			if (!isset($_COOKIE['cookie_inscription']) || $_COOKIE['cookie_inscription'] < 3){
                if (verif_var($_POST['captcha']) && verif_var($_SESSION['captcha']) && $_POST['captcha'] == $_SESSION['captcha']){
                    if (verif_var($_POST['username']) && verif_var($_POST['pseudo']) && verif_var($_POST['email']) && verif_var($_POST['pass']) && verif_var($_POST['pass_conf']) && verif_var($_POST['question']) && verif_var($_POST['reponse']) && verif_var($_POST['reponse_conf'])){
                        if (verif_var($_POST['validcgu'])){
                            if ($_POST['pass'] == $_POST['pass_conf']){
                                if ($_POST['reponse'] == $_POST['reponse_conf']){
                                    if ($_POST['reponse'] != $_POST['question']){
                                        if (is_stringbase($_POST['username'],$_POST['pass'],$_POST['pseudo'])){
                                            if (strlen($_POST['pass']) < 4 || strlen($_POST['pass']) > 50){
                                                $this->msg = "<font color='red'>Il y a trop ou pas assez de caractères dans le mot de passe !</font>";
                                                return $this->msg;
                                            }elseif (strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 30){
                                                $this->msg = "<font color='red'>Il y a trop ou pas assez de caractères dans le pseudo !</font>";
                                                return $this->msg;
                                            }elseif (strlen($_POST['username']) < 4 || strlen($_POST['username']) > 30){
                                                $this->msg = "<font color='red'>Il y a trop ou pas assez de caractères dans le nom de compte !</font>";
                                                return $this->msg;
                                            }elseif (strlen($_POST['email']) < 4 || strlen($_POST['email']) > 100) {
                                                $this->msg = "<font color='red'>Il y a trop ou pas assez de caractères dans l'e-mail !</font>";
                                                return $this->msg;
                                            }elseif ((strlen($_POST['reponse']) < 3 || strlen($_POST['reponse']) > 100) || (strlen($_POST['question']) < 3 || strlen($_POST['question']) > 100)){
                                                $this->msg = "<font color='red'>Il y a trop ou pas assez de caractères dans la question ou la réponse secrête !</font>";
                                                return $this->msg;
                                           
											}
											$login = $this->secu($_POST['username']);
                                            $pass = $this->secu($_POST['pass']);
                                            $email = $this->secu($_POST['email']);
                                            $pseudo = $this->secu($_POST['pseudo']);
                                            $question = $this->secu($_POST['question']);
                                            $reponse = $this->secu($_POST['reponse']);
                                            $ip = get_ip();
                                            $compte = array($login,$pass,$email,$pseudo,$question,$reponse,$ip);
                                            $verif = $this->add("INSERT INTO accounts(account,pass,email,pseudo,question,reponse,ip_register) VALUES (?,?,?,?,?,?,?);",$compte);
                                            $a = (isset($_COOKIE['cookie_inscription']))?$_COOKIE['cookie_inscription']:0;
											if ($verif){
												if (isset($_COOKIE['cookie_inscription'])){
													setcookie('cookie_inscription');
												}
												setcookie('cookie_inscription', $a++, (time()+60*60*24));
                                                $this->msg = "<font color='green'>Vous avez bien été inscrit.</font>";
                                            }else{
                                                $this->msg = "<font color='red'>Une erreur vient de ce produire.</br>Veuillez le signaler au administrateur.</font>";
                                            }
                                        }else{
                                            $this->msg = "<font color='red'>Vous devez utilisé que des caractères type a-Z et 0-9.</font>";
                                        }
                                    }else{
                                        $this->msg = "<font color='red'>La réponse et la question ne doivent pas être identique !</font>";
                                    }
                                }else{
                                    $this->msg = "<font color='red'>Les deux réponses secrètes ne sont pas identique !</font>";
                                }
                            }else{
                                $this->msg = "<font color='red'>Les deux mot de passe ne sont pas identique !</font>";
                            }
                        }else{
                            $this->msg = "<font color='red'>Vous devez approuver et avoir lu le règlement !</font>";
                        } 
                    }else{
                        $this->msg = "<font color='red'>Veuillez remplir tout les champs !</font>";
                    }                    
                }else{
                    $this->msg = "<font color='red'>Captcha incorrect veuillez réessayer.</font>";
                }  
            }else{
                $this->msg = "<font color='red'>Vous ne pouvez plus créer de comptes pour aujourd'hui veuillez revenir dans 24h.</font>";
            }
			}
        }catch (Exception $e){new Erreur($e->getMessage());}
        return $this->msg;
    }
}
?>
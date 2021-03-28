<?php
   
        function get_donner($pdo,$typee){
             try {
                $query = $pdo->prepare("SELECT id,name,fonctions,type FROM `objet_co` WHERE type ='".$typee."'");
                $query->execute();
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                // $jsonobj = json_decode($res[0]["fonctions"],true);
                // $jsonobj["name"] = $res[0]["name"];
                // $jsonobj["id"] = $res[0]["id"];

                return $res;
            } catch(\Throwable $th){
                echo 0;
            }
        }
        function ObjectCO($pdo,int $id,int $idAction = 0, int $status){
            try {
                $query = $pdo->prepare("SELECT * FROM `objet_co` WHERE id = $id");
                $query->execute();
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                $jsonobj = json_decode($res[0]["fonctions"],true);
                $objetexcuter = $jsonobj["action"][$idAction];
                $data = file_get_contents("http://".$res[0]['ip'].":".$res[0]['port']."/?".$objetexcuter['url'].$status);
                $dis["data"] = json_decode($data,true);
                $dis["id"] = $res[0]["id"];
                //var_dump($data);
                return json_encode($dis);
            } catch(\Throwable $th){
                echo $th;
            }
        }
        function ObjectAjout($pdo,$ip,$port,$name = "",$type = ""){
            try {
                $data = file_get_contents("http://".$ip.":".$port."/info");
                $trf = json_decode($data,true);
                $objet_co = json_encode($trf['fonction']);
                // if (isset($trf['eternet']['wlan0'])){

                // }else {

                // }
                var_dump($trf);
                $query = $pdo->prepare('INSERT INTO `objet_co`(`liste_id_user`, `name`, `hostname`, `ip`, `port`, `fonctions`, `type`) VALUES ("1","'.$name.'","'.$trf['hostname'].'","'.$ip.'","'.$port.'",'.json_encode($objet_co).',"'.$type.'")');
                $query->execute();
            } catch(\Throwable $th){
                echo $th;
            }
        }
        function get_status($pdo,$typee){
             try {
                $query = $pdo->prepare("SELECT id,ip,port,type FROM `objet_co` WHERE type ='".$typee."'");
                $query->execute();
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                // foreach(){
                    foreach($res as $resBdd){
                        //var_dump($resBdd);
                             try {
                                
                                $data = file_get_contents("http://".$resBdd['ip'].":".$resBdd['port']."/");
                                
                                if ($data != ""){
                                    $trf = json_decode($data,true);
                                    $dis['id'] = $resBdd['id'];
                                    $dis['data'] = $trf;
                                    $disTotal[$resBdd['id']] = $dis;
                                }else{
                                    $dis1['id'] = $resBdd['id'];
                                    $dis1['data'] = null;
                                    $dis1['error'] = "Ne peut pas étre Connecter.<strong> Velier vérifier la connexion</strong>";
                                    $disTotal[$resBdd['id']] = $dis1;
                                }
                            } catch(\Throwable $th){
                                
                            }               

                           
                        
                        
                    }
                    //var_dump($disTotal);
                    //echo json_encode($disTotal);
                // }
                // $jsonobj = json_decode($res[0]["fonctions"],true);
                // $jsonobj["name"] = $res[0]["name"];
                // $jsonobj["id"] = $res[0]["id"];

                return json_encode($disTotal);
            } catch(\Throwable $th){
                echo 0;
            }
        }
?>
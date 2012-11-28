<?php
function getDetilPasalTersangka($request)
{    
    $conn = Doctrine_Manager::connection();
                $getDataPasalTersangka="select * FROM PDM_PASAL where ID_TERSANGKA='". $request . "' order by id";
                $statement5=$conn->execute($getDataPasalTersangka);
              $statement5->execute();
              $resultDataPasalTersangka=$statement5->fetchAll();
     return    $resultDataPasalTersangka;
}

function getDetails($prefix, $request)
{
    $conn = Doctrine_Manager::connection();
    $getData="select * FROM PDM_".$prefix." where ID_TERSANGKA='". $request . "' order by id";
    $statement=$conn->execute($getData);
    $statement->execute();
    $resultData=$statement->fetchAll();
    return    $resultData;
}

function getSetorDnt($idPerkara, $idTersangka)
{
    $conn = Doctrine_Manager::connection();
    $getData="select * FROM PDM_SETOR_DNT where ID_PERKARA ='".$idPerkara."' and ID_TERSANGKA='".$idTersangka. "' order by id";
    $statement=$conn->execute($getData);
    $statement->execute();
    $resultData=$statement->fetchAll();
    return    $resultData;
}

function getDetailSetor($request, $status)
{
    $conn = Doctrine_Manager::connection();
    $getData="select * FROM PDM_DETAIL_STR where ID_STR_DNT ='".$request."' and status='".$status."' order by id";
    $statement=$conn->execute($getData);
    $statement->execute();
    $resultData=$statement->fetchAll();
    return    $resultData;
}

function getBarangRampasan($request)
{
    $conn = Doctrine_Manager::connection();
    $getData = "select a.*, a.id as idbb, b.* from pdm_barbuk a
                left join pdm_barbuk_lelang b on a.id = b.id_barbuk
                where id_perkara = '".$request."' order by a.id";
    
    $statement = $conn->execute($getData);
    $statement->execute();
    
    $resultData = $statement->fetchAll();
    return $resultData;
}

function getDtnPup($id_tersangka, $id_perkara)
{
   $conn = Doctrine_Manager::connection();
    $getData = "select * from dtn_pup_pds
                where id_tersangka = '".$id_tersangka."' and id_perkara = '".$id_perkara."' order by id";
    
    $statement = $conn->execute($getData);
    $statement->execute();
    
    $resultData = $statement->fetchAll();
    return $resultData; 
}

function getDtnPembayaran($request)
{
    $conn = Doctrine_Manager::connection();
    $getData = "select * from dtn_pup_pembayaran_pds
                where id_pup = '".$request."' order by id";
    
    $statement = $conn->execute($getData);
    $statement->execute();
    
    $resultData = $statement->fetchAll();
    return $resultData; 
}

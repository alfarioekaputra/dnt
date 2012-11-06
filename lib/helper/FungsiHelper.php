<?PHP
function setTanggal($request)
{
    if($request == "")
    {
        return $request;
    }else{
        $date = date('Y/m/d', strtotime($request));

        return $date;
    }
}

function getTanggal($request)
{
    if($request == "")
    {
        return $request;
    }else{
        $date = date('d-m-Y', strtotime($request));

        return $date;
    }
}

function cobaTanggal($request)
{
    if($request == "")
    {
        return $request;
    }else{
        $date = date('d-M-y', strtotime($request));

        return $date;
    }
}

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
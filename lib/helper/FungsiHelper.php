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
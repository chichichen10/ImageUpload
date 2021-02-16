<?php

$sql = "SELECT * FROM images";

$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));

$result = $pdo->query($sql);
$row = $result->fetch();
$type = $row['type'];
// header("Content-type:$type");
// echo pg_unescape_bytea($row['image']);
echo '<img src="data:image/png;base64,' . pg_unescape_bytea($row['image']) . '">';
?>
<!-- <img
    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAA9lBMVEX////vuQrzzQn00Qj44Qf22Qjzywn11Qj45Af55wf0zwj22wj11Aj56Af44gf66wf77wbyxwnxwwn78gbwvgrwvArutQD//vr89Qb+/PX+/O366r799dn99+T55qz78NH00W7435rwvBfyxkn22o766bf00Gjxwzfzyjb89MHzy1T66pf99d/99s777cfxwC711Hv78D344KH11oHzzFz66Lv22HP0zUX545b67bX0zyj101z34HLyxx/33H/11SP55mv55lr99LX55Sr66EH884b771r78W7996n88pT++9j66In33Tv11D3554X10VL442H22Wi9vPWTAAAN+klEQVR4nO2dfVfbNhSHYzt27DixZMtWiIEEEiCUAmGUlr5Q2o6u27qyrt//y0wvfpPtZJTBsaXD7/RQSvqHHq5075V0JXU6T3rSk570pCcpotGo6RY8rrZ3NO246UY8osb7C4yXW0034/E03p3hMFiOm27Ho2l8NtN0z9lpuh2PpvgAhyaAQNlOGs9x2IUQ/dJ0Qx5Lp0sc2giCvqomnMxwABDsRmdNt+RxNDqfaRaE0AxnagbDeE+LDADhQMN7SoaK+EwLexABXcPLadONeQxtkSjhQjS0NEVNeEKihA2RE2iaNlfRhPtLHDgQdUMCqO013ZqH1+g8wgFE0GWAc/Vi4fhci/oQgp6mqWnC+AWOqBPtc8DldtMNemgd75BUmztRKrzbdIMeWqcXNNVGjo854Uy15YtNEiWIE/UCLTHhedMtemDtz7APIOJOlCpUy4Tj3Yik2giaKZ+G95tu04Mq3uVOtIczwLlS+dr2AXOiwMosqEUvm27UQ2p6gQOSajsWzgl34qZb9YA6nePAg9Dzcz5tptIo3F/gYEhS7aAAqJQJJzNsAZJqR0XA2aTpZj2YxtdYM0iUGGiCdpRxpPEZjqgT7WMBcLnZdMMeStuXdL0CAl8E1A6abthDaUqcKEm1BSfKYqEiaxejl3PsOwiKTpSmMxdNN+1hNJossTVM1ysEQkXWLnZnuA8g7EUVwOumm/Yweoe1AYSw5ETZKFQi2MfUiSIIrSog3lNhXni8oE4UOmUnymKhClsxmwvse4ik2lFBqQl35U9nxpOFxpwoAwzD/CulVGARePR6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"> -->
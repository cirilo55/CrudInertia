<?php
function dataAmericanaParaBrasileira($dataAmericana) {
        $partes = explode("-", $dataAmericana);

        if (count($partes) == 3) {
            return $partes[2] . "/" . $partes[1] . "/" . $partes[0];
        } else {
            return false;
        }
}

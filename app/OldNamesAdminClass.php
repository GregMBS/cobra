<?php

namespace App;


use Exception;
use Illuminate\Database\Eloquent\Builder;

class OldNamesAdminClass extends AgentAdminClass
{

    /**
     *
     * @param string $completo
     * @param string $tipo
     * @param string $capt
     */
    private function updateOpenParams($completo, $tipo, $capt) {
        /** @var Builder $nombreQuery */
        $nombreQuery = Nombre::where('iniciales', '=', $capt);
        $nombre = $nombreQuery->first();
        $nombre->completo = $completo;
        $nombre->tipo = $tipo;
        $nombre->save();
    }

    /**
     *
     * @param string $capt
     */
    private function deleteFromUsers($capt) {
        $nombreQuery = Nombre::where('iniciales', '=', $capt);
        try {
            $nombreQuery->delete();
        } catch (Exception $e) {
            //
        }
    }

    /**
     *
     * @param string $pass
     * @param string $capt
     */
    private function updatePassword($pass, $capt) {
        if ((strlen($pass) < 50) && (strlen($pass) > 0)) {
            /** @var Builder $nombreQuery */
            $nombreQuery = Nombre::where('iniciales', '=', $capt)
                ->where('passw','=', sha1($pass));
            $nombre = $nombreQuery->first();
            $completo = $nombre->completo;
            $tipo = $nombre->tipo;
            $this->addToUsers($completo, $tipo, $capt, $pass);
            $this->deleteFromUsers($capt);
        }
    }

    /**
     *
     * @param AgentDataClass $dataClass
     * @return string
     */
    public function changeUserData(AgentDataClass $dataClass)
    {
        $data = $dataClass->getUser();
        $this->updateOpenParams($data->completo, $data->tipo, $data->iniciales);
        $this->updatePassword($data->pass, $data->iniciales);
        return $data->iniciales;
    }

}
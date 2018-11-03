<?php

namespace App;


use Illuminate\Database\Eloquent\Builder;

class OldNamesAdminClass extends AgentAdminClass
{

    /**
     *
     * @param string $fullName
     * @param string $tipo
     * @param string $capt
     */
    private function updateOpenParams($fullName, $tipo, $capt) {
        /** @var Builder $oldNamesQuery */
        $oldNamesQuery = Nombre::where('iniciales', '=', $capt);
        $name = $oldNamesQuery->first();
        $name->completo = $fullName;
        $name->tipo = $tipo;
        $name->save();
    }

    /**
     *
     * @param string $capt
     */
    private function deleteFromUsers($capt) {
        $oldNamesQuery = Nombre::where('iniciales', '=', $capt);
        try {
            $oldNamesQuery->delete();
        } catch (\Exception $e) {
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
            /** @var Builder $oldNamesQuery */
            $oldNamesQuery = Nombre::where('iniciales', '=', $capt)
                ->where('passw','=', sha1($pass));
            $name = $oldNamesQuery->first();
            $fullName = $name->completo;
            $tipo = $name->tipo;
            $this->addToUsers($fullName, $tipo, $capt, $pass);
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
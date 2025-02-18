<?php

namespace App\Livewire;

use App\Models\Desarrolladora;
use App\Models\Distribuidora;
use Livewire\Component;

class SeleccionDistribuidora extends Component
{

    public $distribuidoras;
    public $desarrolladoras = [];
    public $distribuidora_id;
    public $desarrolladora_id;

    public function mount($distribuidora_id = null, $desarrolladora_id = null)
    {
        // Cargar todas las distribuidoras
        $this->distribuidoras = Distribuidora::all();

        // Si ya hay una distribuidora seleccionada, cargar sus desarrolladoras
        if ($distribuidora_id) {
            $this->distribuidora_id = $distribuidora_id;
            $this->actualizarDesarrolladoras();
        }

        $this->desarrolladora_id = $desarrolladora_id;
    }

    public function actualizarDesarrolladoras()
    {
        $this->desarrolladoras = Desarrolladora::where('distribuidora_id', $this->distribuidora_id)->get();
        $this->desarrolladora_id = null; // Resetear desarrolladora al cambiar distribuidora
    }

    public function render()
    {
        return view('livewire.seleccion-distribuidora');
    }
}

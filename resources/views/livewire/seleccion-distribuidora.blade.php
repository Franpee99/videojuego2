<div>
  <!-- Selección de Distribuidora -->
  <label for="distribuidora_id">Distribuidora:</label>
  <select wire:model.live="distribuidora_id" wire:change="actualizarDesarrolladoras">
      <option value="">Selecciona una distribuidora</option>
      @foreach ($distribuidoras as $distribuidora)
          <option value="{{ $distribuidora->id }}">{{ $distribuidora->nombre }}</option>
      @endforeach
  </select>

  <!-- Selección de Desarrolladora -->
  <label for="desarrolladora_id">Desarrolladora:</label>
  <select wire:model.live="desarrolladora_id">
      <option value="">Selecciona una desarrolladora</option>
      @foreach ($desarrolladoras as $desarrolladora)
          <option value="{{ $desarrolladora->id }}">{{ $desarrolladora->nombre }}</option>
      @endforeach
  </select>
</div>

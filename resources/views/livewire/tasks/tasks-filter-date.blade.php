<div>
    <select wire:model.live="selectedMonth" class="block appearance-none w-64 bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        <option value="">Selecione um mês</option>
        
        @foreach($months as $month)  
          <option wire:key="month-{{$month->value}}" value="{{$month->value}}">{{$month->name}}</option>
        @endforeach
      </select>
</div>

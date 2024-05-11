<div>
    <select wire:model.live="selectedCategory" class="block appearance-none w-64 bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
        <option value="">Selecione uma categoria</option>
        
        @foreach($categories as $category)  
          <option wire:key="category-{{$category->id}}" value="{{$category->id}}">{{$category->title}}</option>
        @endforeach
      </select>
</div>

<div class="flex items-center justify-center w-full font-sans bg-gray-100 h-100">
    <div class="w-full p-6 m-4 bg-white rounded shadow lg:w-3/4">
        <div class="mb-4">
            <h1 class="text-3xl font-extrabold tracking-wider text-center text-gray-600">
                {{ ucfirst(Auth::user()->name) }} Todo List
            </h1>
            <div class="flex mt-4">
                <input wire:model="text" wire:keydown.enter="addTodo" required autofocus
                    class="w-full px-3 py-2 mr-4 text-gray-400 border rounded shadow appearance-none @error('text') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                    placeholder="Add Todo">
                <button wire:click="addTodo"
                    class="flex-shrink-0 p-2 text-green-300 border-2 border-green-300 rounded hover:text-white hover:bg-green-300">Add</button>
            </div>
            @error('text')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            @forelse ($todos as $todo)
                <div class="flex items-center mb-4">
                    @if (!$todo->status)
                        <p class="w-full text-gray-600">{{ $todo->text }}</p>
                        <button wire:click="updateTodo('{{ $todo->id }}')"
                            class="flex-shrink-0 p-2 ml-4 mr-2 text-green-300 border-2 border-green-300 rounded hover:text-white hover:bg-green-300">Done</button>
                    @else
                        <p class="w-full text-green-300 line-through">{{ $todo->text }}</p>
                        <button wire:click="updateTodo('{{ $todo->id }}')"
                            class="flex-shrink-0 p-2 ml-4 mr-2 text-gray-400 border-2 border-gray-400 rounded hover:text-white hover:bg-gray-400">
                            Not Done
                        </button>
                    @endif
                    <button wire:click="removeTodo('{{ $todo->id }}')"
                        class="flex-shrink-0 p-2 ml-2 text-red-500 border-2 border-red-500 rounded hover:text-white hover:bg-red-500">Remove</button>
                </div>
            @empty
                <div class="flex items-center mb-4">
                    <p class="w-full text-center text-gray-400">Add a new item to get started!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

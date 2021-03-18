<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoComponent extends Component
{
    public $todos;

    public $text;

    public function mount()
    {
        $this->refreshTodos();
    }

    public function refreshTodos()
    {
        $this->todos = auth()->user()->todos;
    }

    public function addTodo()
    {
        $this->validate([
            'text' => ['required'],
        ]);

        Todo::create([
            'user_id' => auth()->id(),
            'text' => $this->text
        ]);

        $this->text = '';
        $this->refreshTodos();
    }

    public function updateTodo($id)
    {
        $todo = Todo::findOrFail($id);

        $status = $todo->status ? 0 : 1;
        $todo->update(['status' => $status]);

        $this->refreshTodos();
    }

    public function removeTodo($id)
    {
        Todo::findOrFail($id)->delete();
        $this->refreshTodos();
    }
    public function render()
    {
        return view('livewire.todo-component');
    }
}

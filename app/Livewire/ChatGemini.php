<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Auth;

class ChatGemini extends Component
{
    public string $input = '';
    public array $messages = [];
    public bool $loading = false;

    public $user;

    public function mount()
    {
        $this->user = Auth::user()->name;
        // Pesan awal dari bot
        $this->messages[] = [
            'role' => 'assistant',
            'content' => "Halo {$this->user} ! Ada yang bisa saya bantu?"
        ];
    }

    public function askGemini()
    {
        if (trim($this->input) === '') {
            $this->addErrorMessage('Pertanyaan tidak boleh kosong.');
            return;
        }

        // Tambahkan pesan user ke riwayat
        $this->addUserMessage($this->input);
        
        // Reset input field
        $this->input = '';
        
        $this->loading = true;

        try {
            $gemini = new GeminiService();
            $response = $gemini->ask($this->messages[count($this->messages) - 1]['content']);
            
            // Tambahkan respon AI ke riwayat
            $this->addBotMessage($response);
        } catch (\Exception $e) {
            $this->addErrorMessage('Maaf, terjadi kesalahan: ' . $e->getMessage());
        }

        $this->loading = false;
    }

    private function addUserMessage(string $content)
    {
        $this->messages[] = [
            'role' => 'user',
            'content' => $content
        ];
    }

    private function addBotMessage(string $content)
    {
        $this->messages[] = [
            'role' => 'assistant',
            'content' => $content
        ];
    }

    private function addErrorMessage(string $content)
    {
        $this->messages[] = [
            'role' => 'assistant',
            'content' => '<div class="text-red-500">' . $content . '</div>'
        ];
    }

    public function render()
    {
        return view('livewire.chat-gemini');
    }
}
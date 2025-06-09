<div class="min-h-screen bg-gray-100 flex flex-col p-4">
    {{-- Container chat messages, scrollable --}}
    <div
        id="chat-container"
        class="flex-grow overflow-auto space-y-4 mb-24 px-2"
        style="scroll-behavior: smooth;"
    >
        {{-- Loop through all chat messages --}}
        @foreach ($messages as $message)
            @if ($message['role'] === 'assistant')
                {{-- AI Response (left side) --}}
                <div class="max-w-xl bg-gray-200 text-gray-900 rounded-xl px-4 py-3 shadow-md prose prose-sm prose-blue">
                    {!! $message['content'] !!}
                </div>
            @else
                {{-- User Message (right side) --}}
                <div class="max-w-xl ml-auto bg-blue-600 text-white rounded-xl px-4 py-3 shadow-md break-words">
                    {{ $message['content'] }}
                </div>
            @endif
        @endforeach
        
        {{-- Loading indicator --}}
        @if ($loading)
            <div class="max-w-xl bg-gray-200 text-gray-900 rounded-xl px-4 py-3 shadow-md">
                <div class="flex space-x-2">
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                </div>
            </div>
        @endif
    </div>

    {{-- Form input tetap di bawah --}}
    <form wire:submit.prevent="askGemini"
          class="fixed bottom-4 left-4 right-4 bg-white shadow-lg rounded-lg border p-4 flex items-center space-x-2">
        <input
            type="text"
            wire:model="input"
            wire:loading.attr="disabled"
            class="flex-grow rounded border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
            placeholder="Tanya Silahkan Bertanya... 😊"
            autocomplete="off"
            @if($loading) disabled @endif
        />
        <button
            type="submit"
            wire:loading.attr="disabled"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded shadow disabled:opacity-50"
            @if($loading) disabled @endif
        >
            <span wire:loading.remove>Kirim</span>
            <span wire:loading>
                <svg class="animate-spin -ml-1 mr-1 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
        </button>
    </form>
</div>

@push('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/github.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.5.7/dist/typography.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        document.addEventListener('livewire:load', () => {
            Livewire.hook('message.processed', () => {
                hljs.highlightAll();
                
                // Scroll chat ke bawah setiap update
                const container = document.getElementById('chat-container');
                if(container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        });
    </script>
@endpush